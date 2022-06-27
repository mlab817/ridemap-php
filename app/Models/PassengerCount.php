<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'station_id', // id of station
        'passenger_in',
        'passenger_out',
        'user_id', // id of user
        'scanned_at',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
