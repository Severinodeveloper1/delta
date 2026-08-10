<?php

namespace App\Filament\Resources\Companies;

use App\Filament\Resources\Companies\Pages\CreateCompany;
use App\Filament\Resources\Companies\Pages\EditCompany;
use App\Filament\Resources\Companies\Pages\ListCompanies;
use App\Models\Company;
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

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string|null $navigationLabel = 'Configuración General';

    protected static string|\UnitEnum|null $navigationGroup = 'Configuración';

    protected static string|null $modelLabel = 'Configuración';

    protected static string|null $pluralModelLabel = 'Configuración General';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('logo')
                    ->label('Logotipo de la Empresa')
                    ->image()
                    ->directory('companies')
                    ->maxSize(2048),
                Textarea::make('descripcion')
                    ->label('Descripción Corporativa')
                    ->required()
                    ->rows(3),
                TextInput::make('direccion')
                    ->label('Dirección Física')
                    ->required()
                    ->maxLength(255),
                TextInput::make('telefono')
                    ->label('Teléfono de Contacto')
                    ->required()
                    ->maxLength(100),
                TextInput::make('correo')
                    ->label('Correo de Contacto Público')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('correo_notificaciones')
                    ->label('Correo de Envíos e Interno (Recibe Consultas y Cotizaciones)')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->helperText('Las cotizaciones, consultas de clientes y reclamaciones se enviarán a esta dirección de correo.'),
                Textarea::make('ubicacion')
                    ->label('Código Iframe de Google Maps')
                    ->required()
                    ->rows(4)
                    ->helperText('Pegue aquí el código HTML completo <iframe> provisto por Google Maps para la ubicación física.'),
                TextInput::make('horario')
                    ->label('Horario de Atención')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ej. Lunes a Viernes de 9:00 a.m. a 5:00 p.m.'),
                TextInput::make('link_facebook')
                    ->label('Enlace de Facebook')
                    ->url()
                    ->maxLength(255),
                TextInput::make('link_instagram')
                    ->label('Enlace de Instagram')
                    ->url()
                    ->maxLength(255),
                TextInput::make('link_tiktok')
                    ->label('Enlace de TikTok')
                    ->url()
                    ->maxLength(255),
                TextInput::make('link_youtube')
                    ->label('Enlace de YouTube')
                    ->url()
                    ->maxLength(255),
                TextInput::make('link_linkedin')
                    ->label('Enlace de LinkedIn')
                    ->url()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('direccion')
                    ->label('Dirección')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('correo')
                    ->label('Correo Público')
                    ->searchable(),
                TextColumn::make('correo_notificaciones')
                    ->label('Correo Notificaciones')
                    ->searchable(),
                TextColumn::make('telefono')
                    ->label('Teléfono'),
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
            'index' => ListCompanies::route('/'),
            'create' => CreateCompany::route('/create'),
            'edit' => EditCompany::route('/{record}/edit'),
        ];
    }
}
