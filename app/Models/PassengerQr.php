<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerQr extends Model
{
    use HasFactory;

    protected $fillable = [
        'station_id',
        'qr_code',
        'scanned_at',
        'user_id',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
