<?php

namespace App\Filament\Resources\HeroSections;

use App\Filament\Resources\HeroSections\Pages\ManageHeroSections;
use App\Filament\Resources\HeroSections\Pages\ViewHeroSection;
use App\Models\HeroSection;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\View\View;
use UnitEnum;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPresentationChartBar;
    protected static ?string $navigationLabel = 'Hero Section';
    protected static ?int $navigationSort = 4;
    protected static string | UnitEnum | null $navigationGroup = 'Data Pokok Website';



    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('header_1')
                    ->label('Header 1 (Judul Utama)')
                    ->placeholder('Contoh: MI Manba\'ul Huda')
                    ->required(),

                TextInput::make('header_2')
                    ->label('Header 2 (Sub Judul / Lokasi)')
                    ->placeholder('Contoh: Sekaran Balen Bojonegoro')
                    ->required(),

                FileUpload::make('image')
                    ->label('Foto Banner Hero')
                    ->image()
                    ->directory('hero')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->rows(3)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    // 2. INFOLIST TAMPILAN HERO SECTION ID 1
    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Banner Hero Section')
                    ->icon('heroicon-o-presentation-chart-bar')
                    ->schema([
                        Grid::make(1)->schema([
                            TextEntry::make('header_1')
                                ->label('Header 1 (Judul Utama)')
                                ->weight('bold'),

                            TextEntry::make('header_2')
                                ->label('Header 2 (Sub Judul)')
                                ->color('primary')
                                ->weight('bold'),
                        ]),

                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),

                        ImageEntry::make('image')
                            ->label('Foto Banner')
                            ->height(250)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Gambar')->square(),
                TextColumn::make('header_1')->label('Header 1')->searchable(),
                TextColumn::make('header_2')->label('Header 2'),
                TextColumn::make('description')->label('Deskripsi')->limit(50),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ViewHeroSection::route('/'),
        ];
    }
}
