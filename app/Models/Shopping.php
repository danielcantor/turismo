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
        'reservation_number',
        'user_id',
        'product_id',
        'payment_status',
        'payment_method',
        'total_price',
        'quantity',
    ];

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class , 'purchase_code' , 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Boot method to handle auto-incrementing reservation_number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($shopping) {
            if (empty($shopping->reservation_number)) {
                // Get the highest reservation_number and increment
                $maxNumber = static::max('reservation_number') ?? 0;
                $shopping->reservation_number = $maxNumber + 1;
            }
        });
    }

    /**
     * Get formatted reservation number with leading zeros
     */
    public function getFormattedReservationNumberAttribute()
    {
        return str_pad($this->reservation_number, 6, '0', STR_PAD_LEFT);
    }
}
