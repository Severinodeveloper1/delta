<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'imagenes' => 'array',
            'ficha_tecnica' => 'array',
            'destacado' => 'boolean',
            'activo' => 'boolean',
        ];
    }

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
