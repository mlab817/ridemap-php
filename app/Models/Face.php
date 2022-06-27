<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Face extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'face_id',
        'station_id',
        'scanned_at',
        'user_id',
    ];

    public function faces()
    {
        return $this->belongsTo(Station::class);
    }
}
