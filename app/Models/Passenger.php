<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * RAMA Integration: adds passenger_count to RAMA scan
 */
class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_no',
        'station_id', // id of station
        'bound',
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
