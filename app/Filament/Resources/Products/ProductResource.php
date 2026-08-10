<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Models\Product;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static string|null $navigationLabel = 'Productos';

    protected static string|\UnitEnum|null $navigationGroup = 'Catálogo';

    protected static string|null $modelLabel = 'Producto';

    protected static string|null $pluralModelLabel = 'Productos';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->components([
                        TextInput::make('nombre')
                            ->label('Nombre del Equipo')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn(string $operation, $state, callable $set) =>
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null
                            ),
                        TextInput::make('slug')
                            ->label('URL Amigable (Slug)')
                            ->required()
                            ->unique(Product::class, 'slug', ignoreRecord: true)
                            ->maxLength(255),
                        Select::make('taxonomy_id')
                            ->label('Categoría / Sistema')
                            ->relationship('taxonomy', 'nombre')
                            ->required()
                            ->preload()
                            ->searchable(),
                        Select::make('brand_id')
                            ->label('Fabricante / Marca')
                            ->relationship('brand', 'nombre')
                            ->required()
                            ->preload()
                            ->searchable(),
                        TextInput::make('precio_referencial')
                            ->label('Precio Referencial (USD)')
                            ->numeric()
                            ->required()
                            ->prefix('$'),
                        Textarea::make('descripcion_corta')
                            ->label('Descripción Corta')
                            ->rows(2)
                            ->maxLength(500),
                    ]),


                RichEditor::make('desripcion_detallada')
                    ->label('Descripción Detallada'),
                RichEditor::make('especificaciones')
                    ->label('Ficha Técnica (Tabla de especificaciones HTML)'),
                FileUpload::make('imagenes')
                    ->label('Galería de Imágenes')
                    ->multiple()
                    ->image()
                    ->directory('products')
                    ->reorderable()
                    ->maxFiles(10)
                    ->maxSize(3072),
                FileUpload::make('ficha_tecnica')
                    ->label('Brochure / Ficha en PDF')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('fichas')
                    ->maxFiles(1)
                    ->maxSize(10240),
                Toggle::make('destacado')
                    ->label('Destacado en Inicio')
                    ->default(false),
                Toggle::make('activo')
                    ->label('Activo / Visible')
                    ->default(true),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagenes')
                    ->label('Imagen')
                    ->circular()
                    ->stacked()
                    ->limit(1),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('taxonomy.nombre')
                    ->label('Categoría')
                    ->sortable(),
                TextColumn::make('brand.nombre')
                    ->label('Marca')
                    ->sortable(),
                TextColumn::make('precio_referencial')
                    ->label('Precio')
                    ->money('USD')
                    ->sortable(),
                IconColumn::make('destacado')
                    ->label('Destacado')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('activo')
                    ->label('Activo')
                    ->boolean()
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
