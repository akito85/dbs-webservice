<?php

namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\Waypoint;

class Division extends Model
{
    protected $fillable = [
        'waypoint_id',
        'latitude',
        'longitude',
        'sequence'
    ];

    /**
     * The relationship of divisions table
     * 1. divisions.site_id --> sites.id
     * 2. divisions.id --> users.division_id
     */
    public function waypoints()
    {
        return $this->belongsToMany(Waypoint::class, 'waypoints', 'id', 'waypoint_id');
    }

}