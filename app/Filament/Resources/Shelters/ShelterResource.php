<?php

namespace App\Filament\Resources\Shelters;

use App\Filament\Resources\Shelters\Pages;
use App\Models\Shelter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Schemas;
use Filament\Schemas\Components\Section;
use Filament\Tables\Table;

class ShelterResource extends Resource
{
    protected static ?string $model = Shelter::class;
    protected static ?string $navigationLabel = 'اسکان‌ها';
    protected static ?string $pluralModelLabel = 'اسکان‌ها';
    protected static ?string $modelLabel = 'اسکان';   
    protected static ?string $recordTitleAttribute = 'name';    

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-building-office';
    }

    public static function form(Schemas\Schema $schema): Schemas\Schema
    {
        return $schema
            ->schema([
                Section::make('اطلاعات پایه‌ای')
                    ->collapsed(false)
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نام مرکز')
                            ->required()
                            ->validationAttribute('نام مرکز')
                            ->maxLength(255)
                            ->columnSpan(2),

                        Forms\Components\Select::make('province_id')
                            ->label('استان')
                            ->options(fn () => \App\Models\Province::pluck('name', 'id')->toArray())
                            ->searchable()
                            ->native(false)
                            ->required()
                            ->validationAttribute('استان')
                            ->live()
                            ->afterStateUpdated(function ($set) {
                                $set('county_id', null);
                                $set('city_id', null);
                            }),

                        Forms\Components\Select::make('county_id')
                            ->label('شهرستان')
                            ->options(function (callable $get) {
                                $provinceId = $get('province_id');
                                if (!$provinceId) {
                                    return [];
                                }
                                return \App\Models\County::where('province_id', $provinceId)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->searchable()
                            ->native(false)
                            ->required()
                            ->validationAttribute('شهرستان')
                            ->live()
                            ->afterStateUpdated(fn ($set) => $set('city_id', null))
                            ->disabled(fn (callable $get) => !$get('province_id')),

                        Forms\Components\Select::make('city_id')
                            ->label('شهر')
                            ->options(function (callable $get) {
                                $countyId = $get('county_id');
                                if (!$countyId) {
                                    return [];
                                }
                                // Get districts for this county, then get cities
                                $districtIds = \App\Models\District::where('county_id', $countyId)
                                    ->pluck('id');
                                return \App\Models\City::whereIn('district_id', $districtIds)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->searchable()
                            ->native(false)
                            ->validationAttribute('شهر')
                            ->disabled(fn (callable $get) => !$get('county_id')),

                        Forms\Components\TextInput::make('village_name')
                            ->label('نام روستا')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('address')
                            ->label('آدرس')
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('latitude')
                            ->label('طول جغرافیایی')
                            ->numeric()
                            ->step(0.0000001)
                            ->placeholder('مثال: 51.3890'),

                        Forms\Components\TextInput::make('longitude')
                            ->label('عرض جغرافیایی')
                            ->numeric()
                            ->step(0.0000001)
                            ->placeholder('مثال: 35.6892'),

                        Forms\Components\TextInput::make('postal_code')
                            ->label('کد پستی')
                            ->maxLength(20)
                            ->columnSpan(2),

                        Forms\Components\Select::make('shelter_type')
                            ->label('نوع اسکان')
                            ->options([
                                'emergency' => 'اسکان اضطراری',
                                'temporary_site' => 'سایت موقت',
                            ])
                            ->columnSpan(2),
                    ]),

                Section::make('اطلاعات تماس')
                    ->collapsed(true)
                    ->relationship('contact')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('manager_mobile_1')
                            ->label('موبایل 1')
                            ->tel(),

                        Forms\Components\TextInput::make('manager_mobile_2')
                            ->label('موبایل 2')
                            ->tel(),

                        Forms\Components\TextInput::make('manager_mobile_3')
                            ->label('موبایل 3')
                            ->tel(),

                        Forms\Components\TextInput::make('manager_phone_1')
                            ->label('تلفن 1')
                            ->tel(),

                        Forms\Components\TextInput::make('manager_phone_2')
                            ->label('تلفن 2')
                            ->tel(),

                        Forms\Components\TextInput::make('manager_phone_3')
                            ->label('تلفن 3')
                            ->tel(),

                        Forms\Components\TextInput::make('manager_vip_1')
                            ->label('شماره ویژه 1'),

                        Forms\Components\TextInput::make('manager_vip_2')
                            ->label('شماره ویژه 2'),

                        Forms\Components\TextInput::make('manager_vip_3')
                            ->label('شماره ویژه 3'),
                    ]),

                Section::make('ظرفیت')
                    ->collapsed(true)
                    ->relationship('capacity')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('healthy_area')
                            ->label('مساحت سرپوشیده (متر مربع)')
                            ->numeric()
                            ->step(0.01),

                        Forms\Components\TextInput::make('open_area')
                            ->label('مساحت باز (متر مربع)')
                            ->numeric()
                            ->step(0.01),

                        Forms\Components\TextInput::make('emergency_indoor_capacity')
                            ->label('ظرفیت داخل (نفر)')
                            ->numeric()
                            ->step(0.01),

                        Forms\Components\TextInput::make('emergency_outdoor_capacity')
                            ->label('ظرفیت خارج (نفر)')
                            ->numeric()
                            ->step(0.01),

                        Forms\Components\TextInput::make('number_of_people')
                            ->label('تعداد افراد')
                            ->numeric()
                            ->integer()
                            ->columnSpan(2),
                    ]),

                Section::make('زیرساخت')
                    ->collapsed(true)
                    ->relationship('infrastructure')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Toggle::make('has_permanent_shelter')
                            ->label('سایبان دائم'),

                        Forms\Components\TextInput::make('permanent_shelter_count')
                            ->label('تعداد سایبان دائم')
                            ->numeric()
                            ->integer()
                            ->hidden(fn ($get) => !$get('has_permanent_shelter')),

                        Forms\Components\Toggle::make('has_temporary_shelter')
                            ->label('سایبان موقت'),

                        Forms\Components\TextInput::make('temporary_shelter_count')
                            ->label('تعداد سایبان موقت')
                            ->numeric()
                            ->integer()
                            ->hidden(fn ($get) => !$get('has_temporary_shelter')),

                        Forms\Components\Toggle::make('has_permanent_sanitation')
                            ->label('دستشویی دائم'),

                        Forms\Components\TextInput::make('permanent_sanitation_count')
                            ->label('تعداد دستشویی دائم')
                            ->numeric()
                            ->integer()
                            ->hidden(fn ($get) => !$get('has_permanent_sanitation')),

                        Forms\Components\Toggle::make('has_temporary_sanitation')
                            ->label('دستشویی موقت'),

                        Forms\Components\TextInput::make('temporary_sanitation_count')
                            ->label('تعداد دستشویی موقت')
                            ->numeric()
                            ->integer()
                            ->hidden(fn ($get) => !$get('has_temporary_sanitation')),

                        Forms\Components\TextInput::make('tent_count')
                            ->label('تعداد چادرها')
                            ->numeric()
                            ->integer()
                            ->columnSpan(3),

                        Forms\Components\TextInput::make('covered_healthy_area')
                            ->label('مساحت تحت پوشش صحی')
                            ->numeric()
                            ->step(0.01)
                            ->columnSpan(3),

                        Forms\Components\Toggle::make('has_water_system')
                            ->label('سیستم آب‌رسانی'),

                        Forms\Components\Toggle::make('has_sewage_system')
                            ->label('سیستم فاضلاب'),

                        Forms\Components\Toggle::make('has_electricity_system')
                            ->label('سیستم الکتریسیتی'),

                        Forms\Components\Toggle::make('has_gas_system')
                            ->label('سیستم گاز')
                            ->columnSpan(3),
                    ]),

                Section::make('خدمات بهداشتی')
                    ->collapsed(true)
                    ->relationship('healthcare')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('healthcare_service_count')
                            ->label('تعداد خدمات بهداشتی')
                            ->numeric()
                            ->integer(),

                        Forms\Components\TextInput::make('healthcare_team_count')
                            ->label('تعداد تیم پزشکی')
                            ->numeric()
                            ->integer(),

                        Forms\Components\Toggle::make('has_mobile_clinic')
                            ->label('کلینیک سیار'),

                        Forms\Components\Toggle::make('has_fixed_clinic')
                            ->label('کلینیک ثابت'),

                        Forms\Components\Toggle::make('has_emergency_room')
                            ->label('اتاق اورژانس'),

                        Forms\Components\Toggle::make('has_hospitalization')
                            ->label('بخش بستری'),

                        Forms\Components\Toggle::make('facilities_for_healthcare')
                            ->label('تسهیلات درمانی')
                            ->columnSpan(2),
                    ]),

                Section::make('تسهیلات')
                    ->collapsed(true)
                    ->relationship('facility')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Toggle::make('has_sanitation_facilities')
                            ->label('تسهیلات بهداشتی'),

                        Forms\Components\Toggle::make('has_sports_facilities')
                            ->label('تسهیلات ورزشی'),

                        Forms\Components\Toggle::make('has_children_welfare_facilities')
                            ->label('تسهیلات کودکان'),

                        Forms\Components\Toggle::make('has_women_welfare_facilities')
                            ->label('تسهیلات زنان'),

                        Forms\Components\Toggle::make('has_sports_facilities_infrastructure')
                            ->label('زیرساخت ورزشی'),

                        Forms\Components\Toggle::make('has_medical_equipment_storage')
                            ->label('انبار تجهیزات پزشکی'),
                    ]),

                Section::make('دسترسی و استفاده')
                    ->collapsed(true)
                    ->relationship('accessibility')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('distance_to_market')
                            ->label('فاصله تا بازار (کیلومتر)')
                            ->numeric()
                            ->step(0.01),

                        Forms\Components\TextInput::make('distance_to_railway')
                            ->label('فاصله تا ایستگاه قطار (کیلومتر)')
                            ->numeric()
                            ->step(0.01),

                        Forms\Components\TextInput::make('distance_to_main_street')
                            ->label('فاصله تا خیابان اصلی (کیلومتر)')
                            ->numeric()
                            ->step(0.01),

                        Forms\Components\TextInput::make('distance_to_highway')
                            ->label('فاصله تا بزرگراه (کیلومتر)')
                            ->numeric()
                            ->step(0.01),
                    ]),

                Section::make('مشخصات زمین')
                    ->collapsed(true)
                    ->relationship('land')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('soil_slope')
                            ->label('شیب خاک (درصد)')
                            ->numeric()
                            ->step(0.01),

                        Forms\Components\TextInput::make('soil_quality')
                            ->label('کیفیت خاک')
                            ->maxLength(255),

                        Forms\Components\Toggle::make('is_wet_land')
                            ->label('زمین مرطوب'),

                        Forms\Components\Toggle::make('is_swampy')
                            ->label('زمین باتلاقی'),

                        Forms\Components\Toggle::make('land_exit_for_animals')
                            ->label('خروج برای دام'),

                        Forms\Components\Toggle::make('land_accommodation_for_animals')
                            ->label('اسکان برای دام'),
                    ]),

                Section::make('مالکیت و یادداشت‌ها')
                    ->collapsed(true)
                    ->relationship('ownership')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('ownership_type')
                            ->label('نوع مالکیت')
                            ->options([
                                'government' => 'دولتی',
                                'private' => 'خصوصی',
                                'NGO' => 'سازمان‌های غیردولتی',
                                'mixed' => 'مختلط',
                            ]),

                        Forms\Components\Textarea::make('property_notes')
                            ->label('یادداشت‌های مالکیت')
                            ->columnSpan(2),
                    ]),

                Section::make('یادداشت‌های کلی')
                    ->collapsed(true)
                    ->columns(1)
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label('یادداشت‌ها')
                            ->columnSpan(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نام مرکز')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('province.name')
                    ->label('استان')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('county.name')
                    ->label('شهرستان')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('city.name')
                    ->label('شهر')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('shelter_type')
                    ->label('نوع')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'emergency' => 'اضطراری',
                        'temporary_site' => 'موقت',
                        default => '-',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('address')
                    ->label('آدرس')
                    ->limit(30),

                Tables\Columns\TextColumn::make('capacity.emergency_indoor_capacity')
                    ->label('ظرفیت (داخل)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('infrastructure.tent_count')
                    ->label('تعداد چادر')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('contact.manager_mobile_1')
                    ->label('موبایل')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime('Y/m/d')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('shelter_type')
                    ->label('نوع اسکان')
                    ->options([
                        'emergency' => 'اضطراری',
                        'temporary_site' => 'موقت',
                    ]),
            ])
            ->actions([
                EditAction::make()
                    ->label('ویرایش'),
                ViewAction::make()
                    ->label('مشاهده'),
                DeleteAction::make()
                    ->label('حذف'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('حذف انتخاب‌شده‌ها'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShelters::route('/'),
            'create' => Pages\CreateShelter::route('/create'),
            'edit' => Pages\EditShelter::route('/{record}/edit'),
        ];
    }
}
