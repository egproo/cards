<?php

namespace App\Filament\Resources\InvoicecardResource\Pages;

use App\Filament\Resources\InvoicecardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvoicecards extends ListRecords
{
    protected static string $resource = InvoicecardResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
