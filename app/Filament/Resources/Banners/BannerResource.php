<?php

namespace App\Filament\Resources\Banners;

use App\Filament\Resources\Banners\Pages\CreateBanner;
use App\Filament\Resources\Banners\Pages\EditBanner;
use App\Filament\Resources\Banners\Pages\ListBanners;
use App\Models\Banner;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string|null $navigationLabel = 'Banners';

    protected static string|\UnitEnum|null $navigationGroup = 'Contenido';

    protected static string|null $modelLabel = 'Banner';

    protected static string|null $pluralModelLabel = 'Banners';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre / Título Principal')
                    ->required()
                    ->maxLength(255),
                TextInput::make('titulo')
                    ->label('Etiqueta / Badge')
                    ->maxLength(255)
                    ->placeholder('Ej. Líderes en Envasado'),
                Textarea::make('descripcion')
                    ->label('Descripción corta')
                    ->rows(3),
                FileUpload::make('imagen')
                    ->label('Imagen de Fondo')
                    ->image()
                    ->directory('banners')
                    ->required()
                    ->maxSize(3072),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Fondo')
                    ->circular(),
                TextColumn::make('nombre')
                    ->label('Título Principal')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('titulo')
                    ->label('Etiqueta')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado En')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBanners::route('/'),
            'create' => CreateBanner::route('/create'),
            'edit' => EditBanner::route('/{record}/edit'),
        ];
    }
}
