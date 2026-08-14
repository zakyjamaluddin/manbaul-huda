<?php

namespace App\Filament\Resources\WhyUs;

use App\Filament\Resources\WhyUs\Pages\ManageWhyUs;
use App\Models\WhyUs;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class WhyUsResource extends Resource
{
    protected static ?string $model = WhyUs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;
    protected static ?string $navigationLabel = 'Why Us (Keunggulan)';
    protected static ?int $navigationSort = 3;
    protected static string | UnitEnum | null $navigationGroup = 'Data Pokok Website';



    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('icon')
                    ->label('Ikon (FontAwesome / Class)')
                    ->placeholder('Contoh: fa-solid fa-book-quran')
                    ->helperText('Diisi kelas FontAwesome atau ikon yang diinginkan.')
                    ->required(),

                TextInput::make('title')
                    ->label('Judul Keunggulan')
                    ->placeholder('Contoh: Kurikulum Terpadu')
                    ->required(),

                Textarea::make('description')
                    ->label('Deskripsi Keunggulan')
                    ->rows(3)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('icon')->label('Ikon'),
                TextColumn::make('title')->label('Judul')->searchable(),
                TextColumn::make('description')->label('Deskripsi')->limit(60),
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
            'index' => ManageWhyUs::route('/'),
        ];
    }
}
