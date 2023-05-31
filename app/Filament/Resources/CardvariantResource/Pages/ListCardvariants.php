<?php

namespace App\Filament\Resources\CardvariantResource\Pages;

use App\Filament\Resources\CardvariantResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCardvariants extends ListRecords
{
    protected static string $resource = CardvariantResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
