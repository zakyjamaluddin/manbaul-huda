<?php

namespace App\Filament\Resources\AgendaMadrasahs\Pages;

use App\Filament\Resources\AgendaMadrasahs\AgendaMadrasahResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAgendaMadrasahs extends ManageRecords
{
    protected static string $resource = AgendaMadrasahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
