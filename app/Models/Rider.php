<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'plate_no',
        'station_id', // id of station
        'bound',
        'mode', // 1 = load, -1 = unload
        'qr_code',
        'user_id', // id of user
        'scanned_at',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
