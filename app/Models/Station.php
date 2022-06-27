<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    public function faces()
    {
        return $this->hasMany(Face::class);
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'station_id');
    }

    public function kiosks()
    {
        return $this->hasMany(Kiosk::class, 'origin_station_id');
    }
}
