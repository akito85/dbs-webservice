<?php
/**
 * Created by PhpStorm.
 * User: Akito
 * Date: 5/25/2017
 * Time: 2:45 AM
 */

namespace Api\Users\Controllers;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;

class UniversalPushController extends Controller
{
    public function push($deviceToken, Request $request)
    {
        $data = json_decode(json_encode($request->all()), true);

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

        $downstreamResponse = FCM::sendTo($deviceToken, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        return $downstreamResponse;
    }
}