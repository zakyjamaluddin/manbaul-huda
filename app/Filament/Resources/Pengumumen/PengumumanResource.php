<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Pengumumen\Pages\ManagePengumumen;
use App\Models\Pengumuman;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PengumumanResource extends Resource
{
    protected static ?string $model = Pengumuman::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSpeakerWave;
    protected static ?string $navigationLabel = 'Pengumuman Resmi';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Pengumuman')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),


                Select::make('kategoris')
                    ->label('Kategori Pengumuman')
                    ->relationship('kategoris', 'nama')
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
                Toggle::make('is_disematkan')
                    ->label('Sematkan (Pengumuman Utama Berwarna Hijau)')
                    ->helperText('Hanya 1 pengumuman yang bisa disematkan. Pengumuman ini akan ditampilkan paling atas dengan warna hijau khas madrasah.')
                    ->default(false),

                RichEditor::make('konten')
                    ->label('Isi Konten Pengumuman')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->label('Judul Pengumuman')->searchable()->sortable()->wrap(),
                TextColumn::make('kategoris.nama')->label('Kategori')->badge()->color('success'),
                IconColumn::make('is_disematkan')
                    ->label('Disematkan')
                    ->boolean()
                    ->trueIcon('heroicon-o-bookmark')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('warning'),
                TextColumn::make('created_at')->label('Tanggal')->date('d M Y H:i')->sortable(),
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
            'index' => ManagePengumumen::route('/'),
        ];
    }
}
