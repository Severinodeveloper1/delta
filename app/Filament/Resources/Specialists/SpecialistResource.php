<?php

namespace App\Filament\Resources\Specialists;

use App\Filament\Resources\Specialists\Pages\CreateSpecialist;
use App\Filament\Resources\Specialists\Pages\EditSpecialist;
use App\Filament\Resources\Specialists\Pages\ListSpecialists;
use App\Models\Specialist;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class SpecialistResource extends Resource
{
    protected static ?string $model = Specialist::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static string|null $navigationLabel = 'Asesores';

    protected static string|\UnitEnum|null $navigationGroup = 'Contenido';

    protected static string|null $modelLabel = 'Asesor';

    protected static string|null $pluralModelLabel = 'Asesores';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre del Asesor')
                    ->required()
                    ->maxLength(255),
                TextInput::make('cargo')
                    ->label('Cargo / Especialidad')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ej. Especialista en Líquidos'),
                TextInput::make('whatsapp')
                    ->label('Número WhatsApp (con código de país)')
                    ->maxLength(20)
                    ->tel()
                    ->placeholder('Ej. 51987654321')
                    ->helperText('Ingrese solo números, incluyendo el código de país (sin + ni espacios). Ej: 51987654321'),
                FileUpload::make('imagen')
                    ->label('Foto del Asesor')
                    ->image()
                    ->directory('specialists')
                    ->maxSize(2048),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Foto')
                    ->circular(),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('cargo')
                    ->label('Cargo')
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
            'index' => ListSpecialists::route('/'),
            'create' => CreateSpecialist::route('/create'),
            'edit' => EditSpecialist::route('/{record}/edit'),
        ];
    }
}
