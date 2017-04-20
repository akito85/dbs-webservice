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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}