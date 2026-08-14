<?php

namespace App\Filament\Resources\TenagaPendidiks\Pages;

use App\Filament\Resources\TenagaPendidiks\TenagaPendidikResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageTenagaPendidiks extends ManageRecords
{
    protected static string $resource = TenagaPendidikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
