<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Driver;
use Infrastructure\Database\Eloquent\Repository;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class UserSyncRepository extends Repository
{
    public function getModel()
    {
        return new Driver();
    }

    public function userSync($driverToken, array $data)
    {
        $optionBuiler = new OptionsBuilder();
        $optionBuiler->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('my title');
    }

    public function update($driverToken, array $data)
    {

    }

}
