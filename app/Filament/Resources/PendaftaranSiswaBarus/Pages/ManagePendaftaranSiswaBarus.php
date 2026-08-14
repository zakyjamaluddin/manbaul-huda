<?php

namespace App\Filament\Resources\PendaftaranSiswaBarus\Pages;

use App\Filament\Resources\PendaftaranSiswaBarus\PendaftaranSiswaBaruResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePendaftaranSiswaBarus extends ManageRecords
{
    protected static string $resource = PendaftaranSiswaBaruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
