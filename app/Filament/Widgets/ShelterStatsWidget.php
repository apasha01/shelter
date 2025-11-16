<?php

namespace App\Filament\Widgets;

use App\Models\Shelter;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ShelterStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('اسکان ها', Shelter::count())->description('تعداد کل اسکان های ثبت شده')
                ->descriptionIcon('heroicon-m-arrow-trending-up')->color('success'),

            Stat::make('اسکان اضطراری', Shelter::where('shelter_type', 'emergency')->count())
                ->description('تعداد اسکان‌های اضطراری')->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger'),

            Stat::make('سایت موقت', Shelter::where('shelter_type', 'temporary_site')->count())
                ->description('تعداد سایت‌های اسکان موقت')->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),

            Stat::make('استان‌های پوشش‌شده', Shelter::distinct('province_id')->count('province_id'))->description('تعداد استان‌های دارای اسکان')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),

            Stat::make('شهرستان‌های پوشش‌شده', Shelter::distinct('county_id')->count('county_id'))
                ->description('تعداد شهرستان‌های دارای اسکان')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),

            Stat::make('ظرفیت کل', number_format(Shelter::sum('emergency_indoor_capacity') ?? 0))
                ->description('ظرفیت کل اسکان اضطراری داخل')
                ->descriptionIcon('heroicon-m-arrow-trending-up')->color('success'),
        ];
    }
}
