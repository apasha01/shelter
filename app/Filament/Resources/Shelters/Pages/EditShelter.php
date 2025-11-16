<?php

namespace App\Filament\Resources\Shelters\Pages;

use App\Filament\Resources\Shelters\ShelterResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditShelter extends EditRecord
{
    protected static string $resource = ShelterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('حذف')->modalHeading('حذف اسکان')
                ->modalDescription('آیا از حذف این اسکان اطمینان دارید؟'),
        ];
    }

    public function getTitle(): string
    {
        return 'ویرایش اسکان';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        $actions = parent::getFormActions();
        foreach ($actions as $action) {
            match ($action->getName()) { 'save' => $action->label('ذخیره'), 'cancel' => $action->label('انصراف'), default => null, };
        }

        return $actions;
    }
}
