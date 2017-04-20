<?php

namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\Site;

class Region extends Model {

    protected $fillable = [
        'name'
    ];

    public function sites()
    {
        return $this->belongsTo(Site::class, 'region_id', 'id');
    }
}
