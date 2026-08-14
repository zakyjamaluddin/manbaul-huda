<?php


namespace App\Filament\Resources\AgendaMadrasahs;


use App\Filament\Resources\AgendaMadrasahs\Pages\ManageAgendaMadrasahs;
use App\Models\AgendaMadrasah;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class AgendaMadrasahResource extends Resource
{
    protected static ?string $model = AgendaMadrasah::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;
    protected static ?string $navigationLabel = 'Agenda Madrasah';
    protected static string | UnitEnum | null $navigationGroup = 'Informasi dan Publikasi';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Agenda / Kegiatan')
                    ->placeholder('Contoh: Upacara HUT RI, STS Semester 1, Rejeban')
                    ->required(),

                DatePicker::make('tanggal_pelaksanaan')
                    ->label('Tanggal Pelaksanaan')
                    ->required(),

                Select::make('kategori')
                    ->label('Kategori Agenda')
                    ->options([
                        'Rutin Keagamaan' => 'Rutin Keagamaan (Muludan/Rejeban)',
                        'Akademik & Ujian' => 'Akademik & Ujian (STS/ASAS)',
                        'Peringatan Hari Besar' => 'Peringatan Hari Besar',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->required(),

                TextInput::make('lokasi')
                    ->label('Lokasi Kegiatan')
                    ->default('Kompleks MI Manba\'ul Huda')
                    ->required(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi / Catatan Agenda')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal_pelaksanaan')->label('Tanggal')->date('d M Y')->sortable(),
                TextColumn::make('judul')->label('Kegiatan')->searchable()->sortable(),
                TextColumn::make('kategori')->label('Kategori')->badge()->color('info'),
                TextColumn::make('lokasi')->label('Lokasi'),
            ])
            ->defaultSort('tanggal_pelaksanaan', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAgendaMadrasahs::route('/'),
        ];
    }
}
