<?php

namespace App\Filament\Resources\HopitalResource\Pages;

use App\Filament\Resources\HopitalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHopitals extends ListRecords
{
    protected static string $resource = HopitalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
