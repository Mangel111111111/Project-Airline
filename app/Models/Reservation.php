<?php

namespace App\Models;

use App\Models\User;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'flight_id',
        'seat_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    protected static function booted()
    {
        static::creating(function ($reservation) {
            $flight = $reservation->flight;

            if ($flight->availableSeats <= 0) {
                throw new \Exception('No available seats for this flight.');
            }

            $flight->decrement('availableSeats');
        });

        static::deleting(function ($reservation) {
            $reservation->flight->increment('availableSeats');
        });
    }
}
