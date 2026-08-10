<?php

namespace App\Filament\Pages;

use App\Models\About;
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

class ManageAbout extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Sobre Nosotros';

    protected static string|\UnitEnum|null $navigationGroup = 'Configuración';

    protected static ?string $title = 'Sobre Nosotros';

    protected string $view = 'filament.pages.manage-about';

    public ?array $data = [];

    public function mount(): void
    {
        $about = About::firstOrCreate([], [
            'trayectoria' => 'Soluciones integrales de envasado...',
            'anios' => '15+',
            'patentes' => '500+',
            'paises' => '24/7',
            'mision' => 'Proveer maquinaria...',
            'vision' => 'Ser líderes...',
            'valores' => 'Calidad, innovación...',
            'titulo_talento' => 'Ingeniería calificada',
            'descripcion_talento' => 'Contamos con expertos...',
            'subtitulo_1' => 'Tecnología de Punta',
            'subtitulo_1_descripcion' => 'Descripción 1...',
            'subtitulo_2' => 'Soporte Post-Venta',
            'subtitulo_2_descripcion' => 'Descripción 2...',
        ]);

        $this->form->fill($about->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Sobre Nosotros')
                    ->tabs([
                        Tab::make('Trayectoria y Estadísticas')
                            ->icon('heroicon-o-presentation-chart-bar')
                            ->schema([
                                RichEditor::make('trayectoria')
                                    ->label('Trayectoria / Historia')
                                    ->required(),
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('anios')
                                            ->label('Años de Experiencia')
                                            ->required()
                                            ->maxLength(50),
                                        TextInput::make('patentes')
                                            ->label('Equipos Vendidos')
                                            ->required()
                                            ->maxLength(50),
                                        TextInput::make('paises')
                                            ->label('Soporte Técnico (ej: 24/7)')
                                            ->required()
                                            ->maxLength(50),
                                    ]),
                            ]),
                        Tab::make('Misión, Visión y Valores')
                            ->icon('heroicon-o-shield-check')
                            ->schema([
                                RichEditor::make('mision')
                                    ->label('Misión de la Empresa')
                                    ->required(),
                                RichEditor::make('vision')
                                    ->label('Visión Estratégica')
                                    ->required(),
                                RichEditor::make('valores')
                                    ->label('Valores Institucionales')
                                    ->required(),
                            ]),
                        Tab::make('Talento Humano')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('titulo_talento')
                                            ->label('Título de Sección Talento')
                                            ->required()
                                            ->maxLength(255),
                                        FileUpload::make('imagen_talento')
                                            ->label('Foto del Equipo Técnico')
                                            ->image()
                                            ->directory('about')
                                            ->maxSize(2048),
                                    ]),
                                RichEditor::make('descripcion_talento')
                                    ->label('Descripción de Sección Talento')
                                    ->required(),
                            ]),
                        Tab::make('Subtítulos Destacados')
                            ->icon('heroicon-o-bookmark')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Grid::make(1)
                                            ->schema([
                                                TextInput::make('subtitulo_1')
                                                    ->label('Subtítulo Destacado 1')
                                                    ->required()
                                                    ->maxLength(255),
                                                Textarea::make('subtitulo_1_descripcion')
                                                    ->label('Descripción Subtítulo 1')
                                                    ->required()
                                                    ->rows(3),
                                            ]),
                                        Grid::make(1)
                                            ->schema([
                                                TextInput::make('subtitulo_2')
                                                    ->label('Subtítulo Destacado 2')
                                                    ->required()
                                                    ->maxLength(255),
                                                Textarea::make('subtitulo_2_descripcion')
                                                    ->label('Descripción Subtítulo 2')
                                                    ->required()
                                                    ->rows(3),
                                            ]),
                                    ]),
                            ]),
                        Tab::make('Galería de Imágenes')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                        FileUpload::make('imagen_1')
                                            ->label('Imagen Bento 1')
                                            ->image()
                                            ->directory('about'),
                                        FileUpload::make('imagen_2')
                                            ->label('Imagen Bento 2')
                                            ->image()
                                            ->directory('about'),
                                        FileUpload::make('imagen_3')
                                            ->label('Imagen Bento 3')
                                            ->image()
                                            ->directory('about'),
                                        FileUpload::make('imagen_4')
                                            ->label('Imagen Bento 4')
                                            ->image()
                                            ->directory('about'),
                                    ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $about = About::first();
        if ($about) {
            $about->update($this->form->getState());
        }

        Notification::make()
            ->title('Sección Sobre Nosotros guardada correctamente.')
            ->success()
            ->send();
    }
}
