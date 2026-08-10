<?php

namespace App\Filament\Resources\Abouts;

use App\Filament\Resources\Abouts\Pages\CreateAbout;
use App\Filament\Resources\Abouts\Pages\EditAbout;
use App\Filament\Resources\Abouts\Pages\ListAbouts;
use App\Models\About;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static string|null $navigationLabel = 'Sobre Nosotros';

    protected static string|\UnitEnum|null $navigationGroup = 'Configuración';

    protected static string|null $modelLabel = 'Sobre Nosotros';

    protected static string|null $pluralModelLabel = 'Sobre Nosotros';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                RichEditor::make('trayectoria')
                    ->label('Trayectoria / Historia')
                    ->required(),
                TextInput::make('anios')
                    ->label('Años de Experiencia')
                    ->required()
                    ->maxLength(50),
                TextInput::make('patentes')
                    ->label('Equipos Vendidos / Métrica 2')
                    ->required()
                    ->maxLength(50),
                TextInput::make('paises')
                    ->label('Cobertura / Soporte / Métrica 3')
                    ->required()
                    ->maxLength(50),
                FileUpload::make('imagen_1')
                    ->label('Bento Imagen 1')
                    ->image()
                    ->directory('abouts')
                    ->maxSize(2048),
                FileUpload::make('imagen_2')
                    ->label('Bento Imagen 2')
                    ->image()
                    ->directory('abouts')
                    ->maxSize(2048),
                FileUpload::make('imagen_3')
                    ->label('Bento Imagen 3')
                    ->image()
                    ->directory('abouts')
                    ->maxSize(2048),
                FileUpload::make('imagen_4')
                    ->label('Bento Imagen 4')
                    ->image()
                    ->directory('abouts')
                    ->maxSize(2048),
                RichEditor::make('mision')
                    ->label('Misión')
                    ->required(),
                RichEditor::make('vision')
                    ->label('Visión')
                    ->required(),
                RichEditor::make('valores')
                    ->label('Valores')
                    ->required(),
                FileUpload::make('imagen_talento')
                    ->label('Imagen del Equipo')
                    ->image()
                    ->directory('abouts')
                    ->maxSize(3072),
                TextInput::make('titulo_talento')
                    ->label('Título de Talento')
                    ->required()
                    ->maxLength(255),
                Textarea::make('descripcion_talento')
                    ->label('Descripción de Talento')
                    ->required()
                    ->rows(3),
                TextInput::make('subtitulo_1')
                    ->label('Subtítulo 1 (Ej. Instalación)')
                    ->required()
                    ->maxLength(255),
                Textarea::make('subtitulo_1_descripcion')
                    ->label('Descripción Subtítulo 1')
                    ->required()
                    ->rows(2),
                TextInput::make('subtitulo_2')
                    ->label('Subtítulo 2 (Ej. Mantenimiento)')
                    ->required()
                    ->maxLength(255),
                Textarea::make('subtitulo_2_descripcion')
                    ->label('Descripción Subtítulo 2')
                    ->required()
                    ->rows(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo_talento')
                    ->label('Título Talento')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('anios')
                    ->label('Años Experiencia'),
                TextColumn::make('patentes')
                    ->label('Equipos Vendidos'),
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
            'index' => ListAbouts::route('/'),
            'create' => CreateAbout::route('/create'),
            'edit' => EditAbout::route('/{record}/edit'),
        ];
    }
}
