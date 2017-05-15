<?php

namespace Api\Users\Services;

use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\DriverNotFoundException;
use Api\Users\Events\DriverWasUpdated;
use Api\Users\Repositories\UserSyncRepository;

class UserSyncService {
    private $auth;
    private $database;
    private $dispatcher;
    private $userSyncRepository;

    public function _construct(
     AuthManager $auth,
     DatabaseManager $database,
     Dispatcher $dispatcher,
     UserSyncRepository $userSyncRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->userSyncRepository = $userSyncRepository;
    }

    public function userSync($driverToken, array $data) {
        $driver = $this->getRequestedDriver($driverToken);
        $this->userSyncRepository->update($driverToken, $data);
        $this->dispatcher->fire(new DriverWasUpdated($driver));

        return $driver;
    }

    private function getRequestedDriver($driverToken)
    {
        $driver = $this->userSyncRepository->getByToken($driverToken);

        if (is_null($driver)) {
            throw new DriverNotFoundException();
        }

        return $driver;
    }
}