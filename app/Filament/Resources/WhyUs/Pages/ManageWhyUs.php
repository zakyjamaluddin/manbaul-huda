<?php

namespace App\Filament\Resources\WhyUs\Pages;

use App\Filament\Resources\WhyUs\WhyUsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageWhyUs extends ManageRecords
{
    protected static string $resource = WhyUsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
