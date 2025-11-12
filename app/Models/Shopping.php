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
     * Format: 000001-1, 000002-2, etc. (both parts use sequential reservation number)
     * Example: 000005-5 (fifth reservation), 000006-6 (sixth reservation)
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($shopping) {
            if (empty($shopping->code)) {
                // Count existing records to get next sequential number
                // Use lockForUpdate to prevent race conditions
                $count = static::lockForUpdate()->count();
                $nextSequential = $count + 1;
                
                // Temporarily set a placeholder for code (will be updated after save)
                $shopping->code = 'TEMP_' . $nextSequential;
            }
        });

        static::created(function ($shopping) {
            if (strpos($shopping->code, 'TEMP_') === 0) {
                // Extract the sequential number from the temp code
                $sequentialNumber = (int) str_replace('TEMP_', '', $shopping->code);
                
                // Format: 000001-1, 000002-2, etc. (both parts use sequential number)
                $paddedSequential = str_pad($sequentialNumber, 6, '0', STR_PAD_LEFT);
                $shopping->code = $paddedSequential . '-' . $sequentialNumber;
                $shopping->saveQuietly(); // Save without triggering events again
            }
        });
    }
}
