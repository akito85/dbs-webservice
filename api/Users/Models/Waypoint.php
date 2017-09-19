<?php

namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\Trip;

class Waypoint extends Model
{
    protected $fillable = [
        'trip_id',
        'pickup_location',
        'pickup_lat',
        'pickup_lng',
        'dropoff_location',
        'dropoff_lat',
        'dropoff_lng',
        'sequence',
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
        'mileage',
        'checkpoints'
    ];

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trips', 'id', 'trip_id');
    }
}