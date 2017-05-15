<?php

namespace Api\Users\Repositories;

use Api\Users\Models\User;
use Infrastructure\Database\Eloquent\Repository;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

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

    public function syncDriver($driverToken, $data)
    {
        $optionBuiler = new OptionsBuilder();
        $optionBuiler->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder();
        $notificationBuilder->setTitle($data['notification']['title'])
         ->setBody($data['notification']['body'])
         ->setSound($data['notification']['sound']);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data['payloads']);

        $option = $optionBuiler->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($driverToken, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        return $downstreamResponse;
    }

    public function filterDriverStatus(Builder $query, $method, $clauseOperator, $value, $in)
    {
        // check if value is true
        if ($value) {
            $query->whereIn('drivers.status', ['available']);
        }
    }
}
