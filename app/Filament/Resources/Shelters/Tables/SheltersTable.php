<?php

namespace App\Filament\Resources\Shelters\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;


use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SheltersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('نام مرکز')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('province.name')
                    ->label('استان')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('county.name')
                    ->label('شهرستان')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('district.name')
                    ->label('بخش')
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('city.name')
                    ->label('شهر / روستا')
                    ->toggleable()
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
