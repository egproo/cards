<?php

namespace App\Filament\Resources\CardreviewResource\Pages;

use App\Filament\Resources\CardreviewResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCardreviews extends ListRecords
{
    protected static string $resource = CardreviewResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
