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
        return $this->hasMany(Product::class, 'product_type', 'id');
    }

    /**
     * Get all images for the category
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the main image for the category
     */
    public function getMainImage()
    {
        return $this->images()->where('type', 'main')->first();
    }

    /**
     * Get the home image for the category
     */
    public function getHomeImage()
    {
        return $this->images()->where('type', 'home')->first();
    }

    /**
     * Usar el slug para el route model binding
     */
    public function getRouteKeyName()
    {
        return 'id';
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