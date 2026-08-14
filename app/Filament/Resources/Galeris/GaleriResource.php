<?php

namespace App\Filament\Resources\Galeris;

use App\Filament\Resources\Galeris\Pages\ManageGaleris;
use App\Models\Galeri;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;
    protected static ?string $navigationLabel = 'Gallery';
    protected static string | UnitEnum | null $navigationGroup = 'Informasi dan Publikasi';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Foto / Kegiatan')
                    ->required(),

                Select::make('kategoris')
                    ->label('Kategori Galeri')
                    ->relationship('kategoris', 'nama') // Relasi BelongsToMany ke KategoriGaleri
                    ->multiple()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('nama')
                            ->label('Nama Kategori Baru')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                    ])
                    ->required(),

                FileUpload::make('foto')
                    ->label('File Foto Galeri')
                    ->image()
                    ->directory('galeri')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')->label('Foto')->square(),
                TextColumn::make('judul')->label('Judul Kegiatan')->searchable(),
                TextColumn::make('kategoris.nama')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                TextColumn::make('created_at')->label('Tanggal Upload')->date('d M Y'),
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
            'index' => ManageGaleris::route('/'),
        ];
    }
}
