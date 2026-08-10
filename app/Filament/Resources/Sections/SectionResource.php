<?php

namespace App\Filament\Resources\Sections;

use App\Filament\Resources\Sections\Pages\CreateSection;
use App\Filament\Resources\Sections\Pages\EditSection;
use App\Filament\Resources\Sections\Pages\ListSections;
use App\Models\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-duplicate';

    protected static string|null $navigationLabel = 'Sección Inicio';

    protected static string|\UnitEnum|null $navigationGroup = 'Configuración';

    protected static string|null $modelLabel = 'Sección';

    protected static string|null $pluralModelLabel = 'Secciones';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->label('Título de la Sección')
                    ->required()
                    ->maxLength(255),
                Textarea::make('descripcion')
                    ->label('Descripción Principal')
                    ->required()
                    ->rows(3),
                TextInput::make('titulo_garantia')
                    ->label('Título de Garantía')
                    ->required()
                    ->maxLength(255),
                Textarea::make('descripcion_garantia')
                    ->label('Descripción de Garantía')
                    ->required()
                    ->rows(2),
                TextInput::make('titulo_soporte')
                    ->label('Título de Soporte')
                    ->required()
                    ->maxLength(255),
                Textarea::make('descripcion_soporte')
                    ->label('Descripción de Soporte')
                    ->required()
                    ->rows(2),
                TextInput::make('titulo_capacitacion')
                    ->label('Título de Capacitación')
                    ->required()
                    ->maxLength(255),
                Textarea::make('descripcion_capacitacion')
                    ->label('Descripción de Capacitación')
                    ->required()
                    ->rows(2),
                FileUpload::make('imagen')
                    ->label('Imagen Lateral')
                    ->image()
                    ->directory('sections')
                    ->maxSize(3072),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->label('Título Principal')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('titulo_garantia')
                    ->label('Garantía')
                    ->searchable(),
                TextColumn::make('titulo_soporte')
                    ->label('Soporte')
                    ->searchable(),
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
            'index' => ListSections::route('/'),
            'create' => CreateSection::route('/create'),
            'edit' => EditSection::route('/{record}/edit'),
        ];
    }
}
