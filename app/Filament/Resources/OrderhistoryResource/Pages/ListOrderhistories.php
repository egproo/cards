<?php

namespace App\Filament\Resources\OrderhistoryResource\Pages;

use App\Filament\Resources\OrderhistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderhistories extends ListRecords
{
    protected static string $resource = OrderhistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
