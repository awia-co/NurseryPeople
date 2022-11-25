<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClimateZone extends Model
{
    protected $guarded = [];
    protected $table = 'climate_zones';

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }

    public function lowZone()
    {
        return $this->belongsTo(Zone::class, 'low_zone_id');
    }

    public function highZone()
    {
        return $this->belongsTo(Zone::class, 'high_zone_id');
    }
}
