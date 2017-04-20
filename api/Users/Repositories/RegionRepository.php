<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Region;
use Infrastructure\Database\Eloquent\Repository;

class RegionRepository extends Repository
{
    public function getModel()
    {
        return new Region();
    }

    public function create(array $data)
    {
        $region = $this->getModel();

        $region->fill($data);
        $region->save();

        return $region;
    }

    public function update(Region $region, array $data)
    {
        $region->fill($data);

        $region->save();

        return $region;
    }
}