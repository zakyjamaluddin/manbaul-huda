<?php

namespace App\Filament\Resources\Profils\Pages;


use App\Filament\Resources\Profils\ProfilResource;
use App\Models\Profil;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProfil extends ViewRecord
{
    protected static string $resource = ProfilResource::class;


    // KUNCI UTAMA: Memaksa halaman selalu membuka Record Profil ID = 1
    public function mount(int|string $record = 1): void
    {
        $profil = Profil::firstOrCreate(
            ['id' => 1],
            [
                'nama_madrasah' => 'MI Manba\'ul Huda',
                'tagline' => 'Ora Ninggal Tuntunan lan Ora Ketinggalan Zaman',
                'nama_kepala_madrasah' => 'Burhanuddin, S.Sos.',
                'email' => 'mi.manbaulhuda1933@gmail.com',
                'alamat' => 'Kompleks Masjid Raudlatul Huda RT. 05 RW. 01 Desa Sekaran Kec. Balen Kab. Bojonegoro',
                'visi' => 'Terwujudnya Lulusan yang berpegang teguh pada ajaran agama serta unggul dalam Prestasi, dan Peduli terhadap Lingkungan',
                'sambutan_kepala' => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh...</p>',
                'sejarah_singkat' => '<p>Madrasah Ibtidaiyah Manba’ul Huda Sekaran...</p>',
            ]
        );

        parent::mount($profil->id);
    }

    // Header Action untuk Edit via Modal Wizard (Tanpa Aksi Hapus)
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Profil Madrasah')
                ->icon('heroicon-o-pencil-square')
                ->color('primary')
                ->modalHeading('Edit Profil Madrasah')
                ->modalWidth('4xl'),
        ];
    }
}
