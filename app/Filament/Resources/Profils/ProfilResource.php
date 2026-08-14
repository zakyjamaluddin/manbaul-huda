<?php

namespace App\Filament\Resources\Profils;

use App\Filament\Resources\Profils\Pages\ManageProfils;
use App\Filament\Resources\Profils\Pages\ViewProfil;
use App\Models\Profil;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ProfilResource extends Resource
{
    protected static ?string $model = Profil::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;
    protected static ?string $navigationLabel = 'Profil Madrasah';
    // bagaimana agar tampil di sidebar di urutan menu paling atas
    protected static ?int $navigationSort = 2;
    protected static string | UnitEnum | null $navigationGroup = 'Data Pokok Website';


    // 1. FORM WIZARD KEREN (4 Langkah)
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    // LANGKAH 1
                    Step::make('Identitas Utama')
                        ->icon('heroicon-o-academic-cap')
                        ->description('Logo, Nama, & Kepala Madrasah')
                        ->schema([
                            FileUpload::make('logo')
                                ->label('Logo Madrasah (PNG)')
                                ->image()
                                ->directory('profil')
                                ->columnSpanFull(),

                            // FIELD UPLOAD THUMBNAIL OPEN GRAPH (OG IMAGE)
                    FileUpload::make('og_image')
                        ->label('Gambar Thumbnail Open Graph (OG Image Web)')
                        ->helperText('Gambar ini akan tampil saat link website utama dibagikan ke WhatsApp, Facebook, dll.')
                        ->image()
                        ->disk('public')
                        ->directory('profil'),

                            TextInput::make('nama_madrasah')
                                ->label('Nama Madrasah')
                                ->required(),

                            TextInput::make('tagline')
                                ->label('Tagline / Motto')
                                ->placeholder('Ora Ninggal Tuntunan lan Ora Ketinggalan Zaman'),

                            TextInput::make('nama_kepala_madrasah')
                                ->label('Nama Kepala Madrasah')
                                ->required(),

                            TextInput::make('email')
                                ->label('Email Web')
                                ->email()
                                ->required(),
                            TextInput::make('nomor_whatsapp')
                                ->label('Nomor WhatsApp Resmi Admin')
                                ->placeholder('Contoh: 081234567890')
                                ->tel()
                                ->required(),
                        ]),

                    // LANGKAH 2
                    Step::make('Alamat & Medsos')
                        ->icon('heroicon-o-map-pin')
                        ->description('Lokasi & Tautan Medsos Resmi')
                        ->schema([
                            Textarea::make('alamat')
                                ->label('Alamat Lengkap')
                                ->rows(2)
                                ->columnSpanFull()
                                ->required(),

                            TextInput::make('link_gmaps')
                                ->label('Link Google Maps')
                                ->url(),
                            TextInput::make('link_instagram')->label('Link Instagram')->url(),

                            TextInput::make('link_tiktok')
                                ->label('Link TikTok')
                                ->url(),

                            TextInput::make('link_fb')
                                ->label('Link Facebook')
                                ->url(),

                            TextInput::make('link_youtube')
                                ->label('Link YouTube')
                                ->url(),
                        ]),

                    // LANGKAH 3
                    Step::make('Visi & Misi')
                        ->icon('heroicon-o-flag')
                        ->description('Pondasi Moral & Arah Tujuan')
                        ->schema([
                            Textarea::make('visi')
                                ->label('Visi Madrasah')
                                ->rows(3)
                                ->columnSpanFull()
                                ->required(),

                            Repeater::make('misi')
                                ->label('Daftar Poin Misi')
                                ->schema([
                                    TextInput::make('poin_misi')
                                        ->label('Poin Misi')
                                        ->required(),
                                ])
                                ->columnSpanFull(),
                        ]),

                    // LANGKAH 4
                    Step::make('Sambutan & Sejarah')
                        ->icon('heroicon-o-document-text')
                        ->description('Naskah Sambutan & Sejarah')
                        ->schema([
                            RichEditor::make('sambutan_kepala')
                                ->label('Sambutan Kepala Madrasah')
                                ->columnSpanFull()
                                ->required(),

                            RichEditor::make('sejarah_singkat')
                                ->label('Sejarah Singkat')
                                ->columnSpanFull()
                                ->required(),
                        ]),

                    Step::make('Akademik')
                        ->icon('heroicon-o-document-text')
                        ->description('Kaldik, Program Unggulan, & Ekstrakurikuler')
                        ->schema([
                            Select::make('kaldik_blog_id')
                                ->label('Tautan Artikel Blog: Kalender Pendidikan')
                                ->relationship('kaldikBlog', 'judul')
                                ->searchable()
                                ->preload(),

                            Select::make('program_unggulan_blog_id')
                                ->label('Tautan Artikel Blog: Program Unggulan')
                                ->relationship('programUnggulanBlog', 'judul')
                                ->searchable()
                                ->preload(),

                            Select::make('ekstrakurikuler_blog_id')
                                ->label('Tautan Artikel Blog: Ekstrakurikuler')
                                ->relationship('ekstrakurikulerBlog', 'judul')
                                ->searchable()
                                ->preload(),
                        ]),

                ])
                ->columnSpanFull()
                ->skippable(true) // Memudahkan berpindah langkah dengan bebas
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             ImageColumn::make('logo')->label('Logo')->square(),
    //             TextColumn::make('nama_madrasah')->label('Nama Madrasah'),
    //             TextColumn::make('nama_kepala_madrasah')->label('Kepala Madrasah'),
    //             TextColumn::make('email')->label('Email'),
    //         ]);
    // }

    // 2. INFOLIST TAMPILAN KEREN NAN RAPI (Ganti Tabel)
    public static function infolist(Schema $infolist): Schema
    {
        return $infolist
            ->schema([
                Section::make('Identitas Utama Madrasah')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Grid::make(1)->schema([
                            ImageEntry::make('logo')
                                ->label('Logo')
                                ->height(80),

                            ImageEntry::make('og_image')
                                ->label('Gambar Thumbnail Website')
                                ->defaultImageUrl("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLaJ6ihmDNPUjXBywSfdmVDW2VfB2ObGyugR6j2Fnw1BAAPZSQRXpnxXjF&s=10"),

                            TextEntry::make('nama_madrasah')
                                ->label('Nama Madrasah')
                                ->weight('bold'),

                            TextEntry::make('tagline')
                                ->label('Motto / Tagline')
                                ->color('warning'),
                        ]),

                        Grid::make(1)->schema([
                            TextEntry::make('nama_kepala_madrasah')
                                ->label('Kepala Madrasah')
                                ->icon('heroicon-o-user-circle'),

                            TextEntry::make('email')
                                ->label('Email Resmi')
                                ->icon('heroicon-o-envelope')
                                ->copyable(),
                        ]),
                    ]),

                Section::make('Alamat & Kontak Media Sosial')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        TextEntry::make('alamat')
                            ->label('Alamat Lengkap')
                            ->columnSpanFull(),

                        Grid::make(1)->schema([

                            TextEntry::make('nomor_whatsapp')->label('WhatsApp Admin')->icon('heroicon-o-chat-bubble-left-ellipsis')->copyable()->default('-'),
                            TextEntry::make('link_gmaps')->label('Google Maps')->url(fn ($record) => $record->link_gmaps, true)->openUrlInNewTab()->default('-'),
                            TextEntry::make('link_tiktok')->label('TikTok')->url(fn ($record) => $record->link_tiktok, true)->openUrlInNewTab()->default('-'),
                            TextEntry::make('link_fb')->label('Facebook')->url(fn ($record) => $record->link_fb, true)->openUrlInNewTab()->default('-'),
                            TextEntry::make('link_youtube')->label('YouTube')->url(fn ($record) => $record->link_youtube, true)->openUrlInNewTab()->default('-'),
                        ]),
                    ]),

                Section::make('Visi & Misi')
                    ->icon('heroicon-o-flag')
                    ->schema([
                        TextEntry::make('visi')
                            ->label('Visi')
                            ->weight('bold')
                            ->columnSpanFull(),

                        TextEntry::make('misi')
            ->label('Misi Madrasah')
            ->columnSpanFull()
            ->getStateUsing(function ($record) {
                $misi = $record->misi; // Mengambil seluruh array/JSON misi dari Model

                if (blank($misi)) {
                    return '-';
                }

                // Jika data masih string JSON, decode ke array
                if (is_string($misi)) {
                    $misi = json_decode($misi, true) ?? [];
                }

                if (! is_array($misi) || empty($misi)) {
                    return '-';
                }

                // Buat struktur penomoran <ol><li> secara utuh
                $html = '<ol style="list-style-type: decimal !important; padding-left: 1.5rem !important;" class="space-y-2 text-sm font-medium text-slate-800 leading-relaxed">';

                foreach ($misi as $item) {
                    $text = is_array($item) ? ($item['poin_misi'] ?? '') : $item;
                    if (! empty($text)) {
                        $html .= '<li style="list-style-type: decimal !important;">' . e($text) . '</li>';
                    }
                }

                $html .= '</ol>';

                return $html;
            })
            ->html(), // Render HTML <ol><li>
                    ]),

                Section::make('Sambutan Kepala & Sejarah Singkat')
                    ->icon('heroicon-o-document-text')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('sambutan_kepala')
                            ->label('Sambutan Kepala')
                            ->html()
                            ->columnSpanFull(),

                        TextEntry::make('sejarah_singkat')
                            ->label('Sejarah Singkat')
                            ->html()
                            ->columnSpanFull(),
                    ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            // 'index' => ManageProfils::route('/'),
            'index' => ViewProfil::route('/'), // Memaksa halaman selalu membuka Record Profil ID = 1
        ];
    }
}
