<?php

namespace App\Models;

use App\Models\User;
use App\Models\Airplane;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_airport_id',
        'destination_airport_id',
        'departureTime',
        'arrivalTime',
        'airplane_id',
        'seatCapacity',
        'status',
    ];

    public function airplane()
    {
        return $this->belongsTo(Airplane::class);
    }

    public function updateStatus()
    {
        if ($this->availableSeats <= 0 || now()->greaterThan($this->departureTime)) {
            $this->status = 'inactive';
        }

        if ($this->availableSeats > 0 && now()->lessThanOrEqualTo($this->departureTime)) {
            $this->status = 'active';
        }

        $this->save();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'reservations')->withPivot('seat_number')->withTimestamps();
    }

    public function originAirport()
    {
        return $this->belongsTo(Airport::class, 'origin_airport_id');
    }

    public function destinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }

    public function getAvailableSeatsAttribute()
    {
        $reservedSeats = $this->reservations()->count();
        return $this->seatCapacity - $reservedSeats;
    }
}
