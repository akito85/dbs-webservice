<?php

namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\Trip;

class Waypoint extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'status',
        'mileage',
        'trip_id'
    ];

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trips', 'id', 'trip_id');
    }
}