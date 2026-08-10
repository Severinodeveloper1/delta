<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($taxonomy) {
            if ($taxonomy->products()->exists()) {
                throw new \Exception('No puede eliminar este registro porque tiene productos asociados.');
            }
        });
    }
}
