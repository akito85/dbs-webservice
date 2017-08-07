<?php

namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\User;

class Division extends Model
{
    protected $fillable = [
        'name',
        'site_id'
    ];

    public $timestamps = [
        'created_at',
        'updated_at'
    ];

    /**
     * The relationship of divisions table
     * 1. divisions.site_id --> sites.id
     * 2. divisions.id --> users.division_id
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users', 'division_id', 'id');
    }

    public function sites()
    {
        return $this->belongsTo(Site::class, 'site_id', 'id');
    }
}