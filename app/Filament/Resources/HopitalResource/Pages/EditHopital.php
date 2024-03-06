<?php

namespace App\Filament\Resources\HopitalResource\Pages;

use App\Filament\Resources\HopitalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHopital extends EditRecord
{
    protected static string $resource = HopitalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
