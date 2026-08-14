<?php

namespace App\Filament\Widgets;

use App\Models\PendaftaranSiswaBaru;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPpdbWidget extends BaseWidget
{
    protected static ?int $sort = -1;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = '5 Pendaftar PPDB Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(PendaftaranSiswaBaru::query()->latest()->limit(5))
            ->columns([
                TextColumn::make('created_at')->label('Tanggal')->date('d M Y H:i'),
                TextColumn::make('nama_siswa')->label('Nama Siswa')->searchable(),
                TextColumn::make('asal_sekolah')->label('Asal Sekolah'),
                TextColumn::make('nama_orangtua')->label('Orang Tua / Wali'),
                TextColumn::make('nomor_whatsapp_orangtua')
                    ->label('WhatsApp')
                    ->copyable()
                    ->icon('heroicon-m-chat-bubble-left-ellipsis')
                    ->color('success'),
                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'diverifikasi' => 'Diverifikasi',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ]),
            ]);
    }
}
