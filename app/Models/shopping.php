<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;
    
    protected $table = 'shopping';

    protected $fillable = [
        'code',
        'user_id',
        'product_id',
        'payment_status',
        'payment_method',
        'total_price',
    ];

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
