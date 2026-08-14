<?php

namespace App\Filament\Resources\HeroSections\Pages;

use App\Filament\Resources\HeroSections\HeroSectionResource;
use App\Models\HeroSection;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHeroSection extends ViewRecord
{
    protected static string $resource = HeroSectionResource::class;

    // Memaksa halaman selalu membuka Record Hero Section ID = 1
    public function mount(int|string $record = 1): void
    {
        $hero = HeroSection::firstOrCreate(
            ['id' => 1],
            [
                'header_1' => 'MI Manba\'ul Huda',
                'header_2' => 'Sekaran Balen Bojonegoro',
                'description' => 'Mewujudkan generasi yang berpegang teguh pada nilai keagamaan, unggul dalam ilmu pengetahuan dan teknologi, serta peduli terhadap kelestarian lingkungan.',
                'image' => 'hero/default.jpg',
            ]
        );

        parent::mount($hero->id);
    }

    // Header Action untuk Edit via Modal (Tanpa Aksi Hapus)
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Hero Section')
                ->icon('heroicon-o-pencil-square')
                ->color('primary')
                ->modalHeading('Edit Hero Section')
                ->modalWidth('2xl'),
        ];
    }
}
