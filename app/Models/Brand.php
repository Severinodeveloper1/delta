<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($brand) {
            if ($brand->products()->exists()) {
                throw new \Exception('No puede eliminar este registro porque tiene productos asociados.');
            }
        });
    }
}
