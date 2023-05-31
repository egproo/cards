<?php

namespace App\Filament\Resources\RegionResource\Pages;

use App\Filament\Resources\RegionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Log;
use Filament\Support\Exceptions\Halt;

class EditRegion extends EditRecord
{
    protected static string $resource = RegionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
