<?php
  
namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\User;
use Api\Users\Models\Waypoint;

class Trip extends Model
{
    protected $fillable = [
        'driver_id',
        'passenger_id',
        'status',
        'information'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users', 'id', 'user_id');
    }

    public function waypoints()
    {
        return $this->belongsToMany(Waypoint::class, 'waypoints', 'id', 'trip_id');
    }
}