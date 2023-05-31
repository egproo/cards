<?php

namespace App\Filament\Resources\CardserialResource\Pages;

use App\Filament\Resources\CardserialResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCardserials extends ListRecords
{
    protected static string $resource = CardserialResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
