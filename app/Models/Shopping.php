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
     * Boot method to handle auto-incrementing code field
     * Format: 000001-[Database ID]
     * Example: 000001-5, 000001-6, 000001-100
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($shopping) {
            if (empty($shopping->code)) {
                // Format: 000001-[Database ID]
                $paddedSequential = str_pad(1, 6, '0', STR_PAD_LEFT);
                $shopping->code = $paddedSequential . '-' . $shopping->id;
                $shopping->saveQuietly(); // Save without triggering events again
            }
        });
    }
}
