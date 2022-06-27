<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kiosk extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_station_id',
        'destination_station_id',
        'device_id',
        'captured_at',
    ];

    public function origin_station(): BelongsTo
    {
        return $this->belongsTo(Station::class,'origin_station_id');
    }

    public function destination_station(): BelongsTo
    {
        return $this->belongsTo(Station::class,'destination_station_id');
    }
}
