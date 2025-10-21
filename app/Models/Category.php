<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    /**
     * Relación hasMany especificando la foreign key product_category
     * para que coincida con la columna usada en products.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'product_category', 'id');
    }

    /**
     * Usar el slug para el route model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'home_image',
        'subtitle'
    ];
}