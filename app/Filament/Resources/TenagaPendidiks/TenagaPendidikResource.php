<?php

namespace App\Filament\Resources\TenagaPendidiks;

use App\Filament\Resources\TenagaPendidiks\Pages\ManageTenagaPendidiks;
use App\Models\TenagaPendidik;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class TenagaPendidikResource extends Resource
{
    protected static ?string $model = TenagaPendidik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    protected static ?string $navigationLabel = 'Tenaga Pendidik & Guru';
    protected static string | UnitEnum | null $navigationGroup = 'Kesiswaan dan SDM';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama Lengkap & Gelar')
                    ->placeholder('Contoh: Burhanuddin, S.Sos.')
                    ->required(),

                TextInput::make('jabatan')
                    ->label('Jabatan / Wali Kelas')
                    ->placeholder('Contoh: Kepala Madrasah / Wali Kelas 1')
                    ->required(),

                TextInput::make('nomor_wa')
                    ->label('Nomor WhatsApp Kontak')
                    ->placeholder('Contoh: 081234567890')
                    ->tel(),

                TextInput::make('urutan')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(1)
                    ->required(),

                FileUpload::make('foto')
                    ->label('Pasfoto Guru / Pendidik')
                    ->image()
                    ->disk('public')
                    ->directory('guru')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')->label('No')->sortable(),
                ImageColumn::make('foto')->label('Foto')->circular(),
                TextColumn::make('nama')->label('Nama Pendidik')->searchable()->sortable(),
                TextColumn::make('jabatan')->label('Jabatan')->badge()->color('primary'),
                TextColumn::make('nomor_wa')->label('WhatsApp')->copyable()->icon('heroicon-m-chat-bubble-left-ellipsis')->color('success'),
            ])
            ->defaultSort('urutan', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTenagaPendidiks::route('/'),
        ];
    }
}
