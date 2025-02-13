<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'seatCapacity',
    ];
}