<?php

namespace App\Filament\Resources\Profils\Pages;

use App\Filament\Resources\Profils\ProfilResource;
use App\Models\Profil;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Schemas\Schema;

class ManageProfils extends ManageRecords
{
    protected static string $resource = ProfilResource::class;

    protected string $view = 'filament.resources.profil-resource.pages.manage-profils';


    // Render Infolist di Layar
    public function infolist(Schema $schema): Schema
    {
        $record = Profil::first();

        if (! $record) {
            return $schema->components([]);
        }

        return ProfilResource::infolist($schema)
            ->record($record);
    }

    // Header Actions dengan Modal Wizard yang dijamin 100% Terbuka
    protected function getHeaderActions(): array
    {
        $profil = Profil::first();

        // 1. Jika Belum Ada Data: Tampilkan Tombol "Input Profil Utama"
        if (! $profil) {
            return [
                Action::make('createProfil')
                    ->label('Input Profil Utama')
                    ->icon('heroicon-o-plus')
                    ->color('success')
                    ->modalHeading('Input Profil Utama Madrasah')
                    ->modalWidth('4xl')
                    ->form(fn (Schema $schema) => ProfilResource::form($schema))
                    ->action(function (array $data) {
                        Profil::create($data);
                    }),
            ];
        }

        // 2. Jika Data Sudah Ada: Tampilkan Tombol "Edit Profil Madrasah" (Ganti data eksisting)
        return [
            Action::make('editProfil')
                ->label('Edit Profil Madrasah')
                ->icon('heroicon-o-pencil-square')
                ->color('primary')
                ->modalHeading('Edit Profil Madrasah')
                ->modalWidth('4xl')
                ->fillForm(fn () => $profil->toArray()) // Ambil data saat ini untuk diisi ke Wizard
                ->form(fn (Schema $schema) => ProfilResource::form($schema))
                ->action(function (array $data) use ($profil) {
                    $profil->update($data);
                }),
        ];
    }
}
