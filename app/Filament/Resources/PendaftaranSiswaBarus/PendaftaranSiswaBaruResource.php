<?php

namespace App\Filament\Resources\PendaftaranSiswaBarus;

use App\Filament\Resources\PendaftaranSiswaBarus\Pages\ManagePendaftaranSiswaBarus;
use App\Models\PendaftaranSiswaBaru;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class PendaftaranSiswaBaruResource extends Resource
{
    protected static ?string $model = PendaftaranSiswaBaru::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;
    protected static ?string $navigationLabel = 'Pendaftaran Siswa Baru';
    protected static string | UnitEnum | null $navigationGroup = 'Kesiswaan dan SDM';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_siswa')
                    ->label('Nama Lengkap Siswa')
                    ->required(),

                TextInput::make('nisn')
                    ->label('NISN')
                    ->placeholder('10 digit NISN'),

                TextInput::make('asal_sekolah')
                    ->label('Asal Sekolah (TK / RA)')
                    ->required(),

                TextInput::make('nama_orangtua')
                    ->label('Nama Orang Tua / Wali')
                    ->required(),

                TextInput::make('nomor_whatsapp_orangtua')
                    ->label('Nomor WhatsApp Orang Tua')
                    ->tel()
                    ->required(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'diverifikasi' => 'Diverifikasi',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ])
                    ->default('pending')
                    ->required(),

                Textarea::make('alamat_lengkap')
                    ->label('Alamat Lengkap')
                    ->rows(3)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Tanggal')->date('d M Y H:i')->sortable(),
                TextColumn::make('nama_siswa')->label('Nama Siswa')->searchable()->sortable(),
                TextColumn::make('nisn')->label('NISN')->placeholder('-'),
                TextColumn::make('asal_sekolah')->label('Asal Sekolah')->searchable(),
                TextColumn::make('nama_orangtua')->label('Nama Orangtua'),
                TextColumn::make('nomor_whatsapp_orangtua')
                    ->label('No. WhatsApp')
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
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])   // Add any actions you want for the table rows here
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => ManagePendaftaranSiswaBarus::route('/'),
        ];
    }
}
