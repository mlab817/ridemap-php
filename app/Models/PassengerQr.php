<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerQr extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_no',
        'station_id',
        'bound',
        'qr_code',
        'mode',
        'scanned_at',
        'user_id',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
