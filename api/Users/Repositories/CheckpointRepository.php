<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Checkpoint;
use Infrastructure\Database\Eloquent\Repository;

class CheckpointRepository extends Repository
{
    public function getModel()
    {
        return new Checkpoint();
    }

    public function create(array $data)
    {
        $checkpoint = $this->getModel();

        $checkpoint->fill($data);
        $checkpoint->save();

        return $checkpoint;
    }

    public function update(Checkpoint $checkpoint, array $data)
    {
        $checkpoint->fill($data);

        $checkpoint->save();

        return $checkpoint;
    }
}