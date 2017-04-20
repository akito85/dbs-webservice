<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Division;
use Infrastructure\Database\Eloquent\Repository;

class DivisionRepository extends Repository
{
    public function getModel()
    {
        return new Division();
    }

    public function create(array $data)
    {
        $division = $this->getModel();

        $division->fill($data);
        $division->save();

        return $division;
    }

    public function update(Division $division, array $data)
    {
        $division->fill($data);

        $division->save();

        return $division;
    }
}