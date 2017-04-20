<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Waypoint;
use Infrastructure\Database\Eloquent\Repository;

class WaypointRepository extends Repository
{
    public function getModel()
    {
        return new Waypoint();
    }

    public function create(array $data)
    {
        $waypoint = $this->getModel();

        $waypoint->fill($data);
        $waypoint->save();

        return $waypoint;
    }

    public function update(Waypoint $waypoint, array $data)
    {
        $waypoint->fill($data);

        $waypoint->save();

        return $waypoint;
    }
}