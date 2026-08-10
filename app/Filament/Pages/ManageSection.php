<?php

namespace App\Filament\Pages;

use App\Models\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;

class ManageSection extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-window';

    protected static ?string $navigationLabel = 'Sección de Inicio';

    protected static string|\UnitEnum|null $navigationGroup = 'Configuración';

    protected static ?string $title = 'Sección de Inicio (Garantías/Respaldo)';

    protected string $view = 'filament.pages.manage-section';

    public ?array $data = [];

    public function mount(): void
    {
        $section = Section::firstOrCreate([], [
            'titulo' => 'Garantía y Respaldo de Fábrica',
            'descripcion' => 'Brindamos soluciones integrales...',
            'titulo_garantia' => 'Garantía Estructural',
            'descripcion_garantia' => 'Cobertura completa de 1 año contra defectos...',
            'titulo_soporte' => 'Soporte Técnico Especializado',
            'descripcion_soporte' => 'Atención inmediata y repuestos...',
            'titulo_capacitacion' => 'Capacitación Operativa',
            'descripcion_capacitacion' => 'Inducción certificada para operarios...',
        ]);

        $this->form->fill($section->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Sección de Inicio')
                    ->tabs([
                        Tab::make('Información de Cabecera')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->schema([
                                TextInput::make('titulo')
                                    ->label('Título de Sección de Confianza')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('descripcion')
                                    ->label('Descripción de la Sección')
                                    ->required()
                                    ->rows(4),
                                FileUpload::make('imagen')
                                    ->label('Imagen Lateral Destacada')
                                    ->image()
                                    ->directory('sections')
                                    ->maxSize(2048),
                            ]),
                        Tab::make('Servicios / Pilares de Confianza')
                            ->icon('heroicon-o-shield-check')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        Grid::make(1)
                                            ->schema([
                                                TextInput::make('titulo_garantia')
                                                    ->label('Título Pilar 1 (Garantía)')
                                                    ->required()
                                                    ->maxLength(255),
                                                Textarea::make('descripcion_garantia')
                                                    ->label('Descripción Pilar 1')
                                                    ->required()
                                                    ->rows(4),
                                            ]),
                                        Grid::make(1)
                                            ->schema([
                                                TextInput::make('titulo_soporte')
                                                    ->label('Título Pilar 2 (Soporte)')
                                                    ->required()
                                                    ->maxLength(255),
                                                Textarea::make('descripcion_soporte')
                                                    ->label('Descripción Pilar 2')
                                                    ->required()
                                                    ->rows(4),
                                            ]),
                                        Grid::make(1)
                                            ->schema([
                                                TextInput::make('titulo_capacitacion')
                                                    ->label('Título Pilar 3 (Capacitación)')
                                                    ->required()
                                                    ->maxLength(255),
                                                Textarea::make('descripcion_capacitacion')
                                                    ->label('Descripción Pilar 3')
                                                    ->required()
                                                    ->rows(4),
                                            ]),
                                    ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $section = Section::first();
        if ($section) {
            $section->update($this->form->getState());
        }

        Notification::make()
            ->title('Sección de inicio guardada correctamente.')
            ->success()
            ->send();
    }
}
