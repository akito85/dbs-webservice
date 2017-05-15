<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Driver;
use Infrastructure\Database\Eloquent\Repository;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

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

    public function syncUser($userToken, array $data)
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

        $downstreamResponse = FCM::sendTo($userToken, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        return $downstreamResponse;
    }
}