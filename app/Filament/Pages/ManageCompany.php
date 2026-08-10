<?php

namespace App\Filament\Pages;

use App\Models\Company;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;

class ManageCompany extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Configuración General';

    protected static string|\UnitEnum|null $navigationGroup = 'Configuración';

    protected static ?string $title = 'Configuración General';

    protected string $view = 'filament.pages.manage-company';

    public ?array $data = [];

    public function mount(): void
    {
        $company = Company::firstOrCreate([], [
            'descripcion' => 'Líderes en fabricación de maquinaria industrial...',
            'direccion' => 'Av. Industrial 123, Lima, Perú',
            'telefono' => '+51 907 507 341',
            'correo' => 'ventas@deltapack.pe',
            'correo_notificaciones' => 'notificaciones@deltapack.pe',
            'ubicacion' => '<iframe src="https://www.google.com/maps/embed?..."></iframe>',
            'horario' => 'Lun - Vie: 8:00 AM - 6:00 PM',
            'ruc' => '20123456789',
            'terminos_condiciones' => 'Términos y condiciones por defecto...',
            'politicas_privacidad' => 'Políticas de privacidad por defecto...',
        ]);

        $this->form->fill($company->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Configuración General')
                    ->tabs([
                        Tab::make('Información Institucional')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('ruc')
                                            ->label('R.U.C. de la Empresa')
                                            ->required()
                                            ->maxLength(20)
                                            ->placeholder('Ej. 20601234567'),
                                        FileUpload::make('logo')
                                            ->label('Logo de la Empresa')
                                            ->image()
                                            ->directory('company')
                                            ->maxSize(2048),
                                    ]),
                                RichEditor::make('descripcion')
                                    ->label('Descripción / Resumen de la Empresa')
                                    ->required(),
                            ]),
                        Tab::make('Contacto y Horarios')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('telefono')
                                            ->label('Teléfono de Contacto')
                                            ->required()
                                            ->maxLength(50),
                                        TextInput::make('correo')
                                            ->label('Correo Electrónico Público')
                                            ->email()
                                            ->required()
                                            ->maxLength(100),
                                        TextInput::make('correo_notificaciones')
                                            ->label('Correo para Notificaciones / Envíos')
                                            ->email()
                                            ->required()
                                            ->maxLength(100),
                                    ]),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('direccion')
                                            ->label('Dirección Física')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('horario')
                                            ->label('Horario de Atención')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                                Textarea::make('ubicacion')
                                    ->label('Código Embed de Google Maps (Iframe)')
                                    ->required()
                                    ->rows(4)
                                    ->placeholder('Pegue el código HTML <iframe> del mapa de Google aquí'),
                            ]),
                        Tab::make('Redes Sociales')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('link_facebook')
                                            ->label('Facebook URL')
                                            ->url()
                                            ->placeholder('https://facebook.com/...'),
                                        TextInput::make('link_instagram')
                                            ->label('Instagram URL')
                                            ->url()
                                            ->placeholder('https://instagram.com/...'),
                                        TextInput::make('link_tiktok')
                                            ->label('TikTok URL')
                                            ->url()
                                            ->placeholder('https://tiktok.com/...'),
                                        TextInput::make('link_youtube')
                                            ->label('YouTube URL')
                                            ->url()
                                            ->placeholder('https://youtube.com/...'),
                                        TextInput::make('link_linkedin')
                                            ->label('LinkedIn URL')
                                            ->url()
                                            ->placeholder('https://linkedin.com/...'),
                                    ]),
                            ]),
                        Tab::make('Textos Legales')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                RichEditor::make('terminos_condiciones')
                                    ->label('Términos y Condiciones')
                                    ->required(),
                                RichEditor::make('politicas_privacidad')
                                    ->label('Políticas de Privacidad')
                                    ->required(),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $company = Company::first();
        if ($company) {
            $company->update($this->form->getState());
        }

        Notification::make()
            ->title('Configuración general guardada correctamente.')
            ->success()
            ->send();
    }
}
