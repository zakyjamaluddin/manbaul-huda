<?php

namespace App\Filament\Resources\Prestasis;

use App\Filament\Resources\Prestasis\Pages\ManagePrestasis;
use App\Models\Prestasi;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTrophy;
    protected static ?string $navigationLabel = 'Prestasi';
    protected static string | UnitEnum | null $navigationGroup = 'Kesiswaan dan SDM';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Prestasi')
                    ->placeholder('Contoh: Olimpiade Matematika')
                    ->required(),

                TextInput::make('prestasi')
                    ->label('Peringkat / Tingkat')
                    ->placeholder('Contoh: Juara 1 Tingkat Kabupaten')
                    ->required(),

                FileUpload::make('foto')
                    ->label('Foto Dokumen / Penyerahan')
                    ->image()
                    ->directory('prestasi')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi Prestasi')
                    ->rows(3)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')->label('Foto')->square(),
                TextColumn::make('judul')->label('Judul')->searchable(),
                TextColumn::make('prestasi')->label('Tingkat')->badge()->color('warning'),
                TextColumn::make('created_at')->label('Tanggal')->date('d M Y'),
            ])
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
            'index' => ManagePrestasis::route('/'),
        ];
    }
}
