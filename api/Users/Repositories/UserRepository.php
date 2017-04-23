<?php

namespace Api\Users\Repositories;

use Api\Users\Models\User;
//use Illuminate\Database\Query\Builder;
use Infrastructure\Database\Eloquent\Repository;

class UserRepository extends Repository
{
    public function getModel()
    {
        return new User();
    }

    public function create(array $data)
    {
        $user = $this->getModel();

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $user->fill($data);
        $user->save();

        return $user;
    }

    public function update(User $user, array $data)
    {
        $user->fill($data);

        $user->save();

        return $user;
    }

    public function filterDriverStatus(Builder $query, $method, $clauseOperator, $value, $in)
    {
        // check if value is true
        if ($value) {
            $query->whereIn('drivers.status', ['available']);
        }
    }
}
