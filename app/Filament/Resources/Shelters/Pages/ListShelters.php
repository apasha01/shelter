<?php

namespace App\Filament\Resources\Shelters\Pages;

use App\Filament\Resources\Shelters\ShelterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShelters extends ListRecords
{
    protected static string $resource = ShelterResource::class;

    public function getTitle(): string
    {
        return ' لیست اسکان ها';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('ایجاد اسکان جدید'),
        ];
    }
}
