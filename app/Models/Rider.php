<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_no',
        'station_id', // id of station
        'route_code',
        'mode', // 1 = load, -1 = unload
        'qr_info',
        'user_id', // id of user
        'scanned_at',
    ];
}
