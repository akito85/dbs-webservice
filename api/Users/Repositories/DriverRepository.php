<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Driver;
use Illuminate\Database\Query\Builder;
use Infrastructure\Database\Eloquent\Repository;

class DriverRepository extends Repository
{
    public function getModel()
    {
      return new Driver();
    }

    public function create(array $data)
    {
        $driver = $this->getModel();

        $driver->fill($data);
        $driver->save();

        return $driver;
    }

    public function update(Driver $driver, array $data)
    {
        $driver->fill($data);

        $driver->save();

        return $driver;
    }

    public function filterDriverStatus(Builder $query, $method, $clauseOperator, $value, $in)
    {
        // check if value is true
        if ($value) {
            $query->whereIn('drivers.status', ['available']);
        }
    }
}