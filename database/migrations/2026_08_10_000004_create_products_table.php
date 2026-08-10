<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('imagenes')->nullable();
            $table->decimal('precio_referencial', 10, 2)->default(0.00);
            $table->text('descripcion_corta')->nullable();
            $table->text('desripcion_detallada')->nullable();
            $table->text('especificaciones')->nullable();
            $table->text('ficha_tecnica')->nullable();
            $table->boolean('destacado')->default(false);
            $table->boolean('activo')->default(true);
            
            $table->foreignId('taxonomy_id')
                ->nullable()
                ->constrained('taxonomies')
                ->restrictOnDelete();
                
            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brands')
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
