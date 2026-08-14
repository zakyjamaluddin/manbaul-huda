<?php

namespace App\Filament\Resources\Blogs;

use App\Filament\Resources\Blogs\Pages\ManageBlogs;
use App\Models\Blog;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static ?string $navigationLabel = 'Blog & Berita';
    protected static string | UnitEnum | null $navigationGroup = 'Informasi dan Publikasi';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Judul Artikel / Video')
                    ->required(),

                Select::make('kategoris')
                    ->label('Kategori Blog')
                    ->relationship('kategoris', 'nama') // Menggunakan relasi kategoris() pada Model Blog
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
                    ->label('Sematkan (Headline Utama)')
                    ->helperText('Hanya boleh ada 1 postingan yang disematkan. Jika ini diaktifkan, postingan lama otomatis dilepas.')
                    ->default(false),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail (Foto)')
                    ->image()
                    ->directory('blog')
                    ->required()
                    ->columnSpanFull(),

                RichEditor::make('konten')
                    ->label('Isi Konten Artikel')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')->label('Thumbnail')->square(),
                TextColumn::make('judul')->label('Judul')->searchable()->wrap(),
                TextColumn::make('kategoris.nama')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                IconColumn::make('is_disematkan')
                    ->label('Disematkan')
                    ->boolean()
                    ->trueIcon('heroicon-o-bookmark')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('warning'),
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
            'index' => ManageBlogs::route('/'),
        ];
    }
}
