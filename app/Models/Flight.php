<?php

namespace App\Models;

use App\Models\Airplane;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin',
        'destination',
        'departureTime',
        'arrivalTime',
        'airplane_id',
        'availableSeats',
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
}
