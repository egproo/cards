<?php

namespace App\Filament\Resources\CurrencyResource\Pages;

use App\Filament\Resources\CurrencyResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCurrencies extends ListRecords
{
    protected static string $resource = CurrencyResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver(),
        ];
    }

    protected function getTitle() : string 
    {
        return __('words.currencies');
    }
    public function getModelLabel(): string
    {
        return __('words.currency');

    }     
}
