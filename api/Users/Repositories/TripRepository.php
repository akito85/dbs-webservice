<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Trip;
use Infrastructure\Database\Eloquent\Repository;

class TripRepository extends Repository
{
    public function getModel()
    {
        return new Trip();
    }

    public function create(array $data)
    {
        $trip = $this->getModel();

        $trip->fill($data);
        $trip->save();

        return $trip;
    }

    public function update(Trip $trip, array $data)
    {
        $trip->fill($data);

        $trip->save();

        return $trip;
    }
}