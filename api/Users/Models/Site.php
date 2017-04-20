<?php

namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\User;
use Api\Users\Models\Division;
use Api\Users\Models\Region;

class Site extends Model
{
    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'region_id'
    ];

    /**
     * The relationship of divisions table
     * 1. sites.id --> divisions.site_id
     * 2. sites.region_id --> region.id
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users', 'id', 'user_id');
    }

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'site_id', 'id');
    }

    public function regions()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
}