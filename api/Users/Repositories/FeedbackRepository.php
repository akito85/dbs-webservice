<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Feedback;
use Infrastructure\Database\Eloquent\Repository;

class FeedbackRepository extends Repository
{
    public function getModel()
    {
        return new Feedback();
    }

    public function create(array $data)
    {
        $feedback = $this->getModel();

        $feedback->fill($data);
        $feedback->save();

        return $feedback;
    }

    public function update(Feedback $feedback, array $data)
    {
        $feedback->fill($data);

        $feedback->save();

        return $feedback;
    }
}