<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_name',
        'product_price',
        'product_description',
        'product_category',
        'product_image',
        'product_activate',
        'days',
        'nights'
    ];

    /**
     * Obtiene un producto por id
     */
    public function getProduct($id)
    {
        return self::find($id);
    }

    /**
     * Obtiene productos por categoría (se alinea con la columna product_category)
     */
    public function getProductsbyType($id)
    {
        return self::where('product_type', $id)
            ->where('product_activate', 1)
            ->get();
    }

    /**
     * Relación con Category usando la columna product_category como foreign key
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category', 'id');
    }

    /**
     * Relación con DepartureDate - un producto puede tener múltiples fechas de salida
     */
    public function departureDates()
    {
        return $this->hasMany(DepartureDate::class, 'product_id', 'id');
    }

    /**
     * Get all images for the product
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the main image for the product
     */
    public function getMainImage()
    {
        return $this->images()->where('type', 'main')->first();
    }

    /**
     * Get all slider images for the product
     */
    public function getSliderImages()
    {
        return $this->images()->where('type', 'slider')->orderBy('order')->get();
    }
}