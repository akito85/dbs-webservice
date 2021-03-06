<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Driver;
use Infrastructure\Database\Eloquent\Repository;
use Illuminate\Support\Facades\Mail;
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

    public function checkout()
    {
        $drivers = $this->getModel();
        //$checkout = $driver::where('status', 'Available')->update(['status' => 'Unavailable']);

        $driverStatus = $drivers->join('users', 'drivers.user_id', '=', 'users.id')
                                ->select('drivers.*', 'users.token')
                                ->where('drivers.status', 'available')
                                ->get();

        if (!$driverStatus->isEmpty()) {
            foreach ($driverStatus as $driver) {
                $driver->update(['status' => 'unavailable']);
                $this->syncUser($driver->token, [
                    'notification' =>
                        ['title' => 'Time is up!', 'body' => 'The day is over. Time to go home.', 'sound' => 'default'],
                    'payloads' =>    
                        ['title' => 'Time is up!', 'message' => 'The day is over. Time to go home.', 'status' => 'checkout']
                ]);
            }

            //$this->sendNotification('Driver Checkout by 17:00');
        }

        return $driverStatus;
    }

    public function sendNotification($content)
    {
        Mail::raw($content, function ($message) {
           $message->to('info@noxus.co.id')->subject('Driver Checked Out');
        });

        return response()->json(['message' => 'Request completed']);       
    }
}