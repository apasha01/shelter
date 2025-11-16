<?php

namespace App\Filament\Resources\Shelters\Pages;

use App\Filament\Resources\Shelters\ShelterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateShelter extends CreateRecord
{
    protected static string $resource = ShelterResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'ایجاد اسکان جدید';
    }

    protected function getFormActions(): array
    {
        $actions = parent::getFormActions();
        foreach ($actions as $action) {
            match ($action->getName()) { 'create' => $action->label('ایجاد'),
                'createAnother' => $action->label('ایجاد و ایجاد دوباره'), default => null,
            };
        }

        return $actions;
    }
}
