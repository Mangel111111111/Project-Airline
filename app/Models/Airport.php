<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'country',
    ];

    public function departingFlights()
    {
        return $this->hasMany(Flight::class, 'origin_airport_id');
    }

    public function arrivingFlights()
    {
        return $this->hasMany(Flight::class, 'destination_airport_id');
    }
}
