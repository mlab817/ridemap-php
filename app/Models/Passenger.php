<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'plate_no',
        'station_id', // id of station
        'bound',
        'passenger_in',
        'passenger_out',
        'user_id', // id of user
        'scanned_at',
    ];
}
