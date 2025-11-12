<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'nombre',
        'apellido',
        'nacimiento',
        'email',
        'nacionalidad',
        'documento',
        'celular',
        'dieta_tipo',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }

}
