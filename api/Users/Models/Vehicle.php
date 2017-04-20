<?php

namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\User;
use Api\Users\Models\Waypoint;

class Vehicle extends Model
{
    protected $fillable = [
        'driver_id',
        'kilometer',
        'license_plate',
        'name',
        'ownership',
        'year'
    ];

    public function drivers()
    {
        return $this->belongsToMany(User::class, 'users', 'id', 'driver_id');
    }
}