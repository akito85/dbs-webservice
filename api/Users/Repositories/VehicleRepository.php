<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Vehicle;
use Infrastructure\Database\Eloquent\Repository;

class VehicleRepository extends Repository
{
    public function getModel()
    {
        return new Vehicle();
    }

    public function create(array $data)
    {
        $vehicle = $this->getModel();

        $vehicle->fill($data);
        $vehicle->save();

        return $vehicle;
    }

    public function update(Vehicle $vehicle, array $data)
    {
        $vehicle->fill($data);

        $vehicle->save();

        return $vehicle;
    }
}