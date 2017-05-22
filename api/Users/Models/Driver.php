<?php

namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\User;

class Driver extends Model
{
    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'status'
    ];

    /**
     * The relationship of drivers table
     * 1. drivers.user_id --> users.id
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'drivers', 'user_id', 'id');
    }
}