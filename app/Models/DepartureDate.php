<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartureDate extends Model
{
    use HasFactory;

    protected $table = 'departure_dates';
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'date'
    ];

    /**
     * Relación con Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
