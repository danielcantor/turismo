<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'type',
        'order',
        'imageable_id',
        'imageable_type'
    ];

    protected $appends = ['url'];

    /**
     * Get the parent imageable model (Category, Product, etc.)
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Get the full URL for the image
     */
    public function getUrlAttribute()
    {
        return \Storage::url($this->path);
    }
}
