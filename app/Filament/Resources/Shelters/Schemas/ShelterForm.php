<?php

namespace App\Filament\Resources\Shelters\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ShelterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('اطلاعات مکانی')->columns(2)->schema([
                    TextInput::make('name')
                        ->label('نام مرکز')
                        ->required()
                        ->maxLength(255),

                    Select::make('province_id')->label('استان')->relationship('province', 'name')
                        ->searchable()
                        ->required(),

                    Select::make('county_id')->label('شهرستان')->relationship('county', 'name')
                        ->searchable()
                        ->required(),

                    Select::make('district_id')->label('بخش')->relationship('district', 'name')
                        ->searchable()
                        ->nullable(),

                    Select::make('city_id')->label('شهر / روستا')->relationship('city', 'name')
                        ->searchable()
                        ->nullable(),

                    TextInput::make('village_name')->label('نام روستا (در صورت نیاز)')
                        ->maxLength(255)
                        ->hidden(fn ($get) => ! is_null($get('city_id'))),

                    TextInput::make('address')
                        ->label('آدرس')
                        ->columnSpanFull(),

                    TextInput::make('map_link')->label('لینک نقشه (مثلاً Google Maps)')->url()->nullable(),

                    TextInput::make('latitude')->label('عرض جغرافیایی')->numeric()->nullable(),

                    TextInput::make('longitude')->label('طول جغرافیایی')->numeric()->nullable(),

                    TextInput::make('postal_code')
                        ->label('کدپستی')
                        ->maxLength(20)
                        ->nullable(),
                ]),
        ]);
    }
}
