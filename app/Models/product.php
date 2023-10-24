<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_name',
        'product_price',
        'product_description',
        'product_category',
        'product_image'
    ];
    public function getProduct($id){
        return $this::find($id);
    }
    public function getProductsbyType($id){
        return $this::where('product_type', $id)->where('product_activate', 1)->get();
    }
    use HasFactory;
}
