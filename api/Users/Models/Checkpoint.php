<?php

namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\Waypoint;

class Checkpoint extends Model
{
    protected $fillable = [
        'waypoint_id',
        'latitude',
        'longitude',
        'sequence'
    ];

    public function waypoints()
    {
        return $this->belongsToMany(Waypoint::class, 'waypoints', 'id', 'waypoint_id');
    }

}