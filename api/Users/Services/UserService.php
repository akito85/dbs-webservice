<?php

namespace Api\Users\Services;

use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\UserNotFoundException;
use Api\Users\Events\UserWasCreated;
use Api\Users\Events\UserWasDeleted;
use Api\Users\Events\UserWasUpdated;
use Api\Users\Repositories\UserRepository;
use Optimus\Bruno\EloquentBuilderTrait;

use Api\Users\Repositories\TripRepository;
use Api\Users\Repositories\DriverRepository;
use Api\Users\Repositories\WaypointRepository;

class UserService
{
    use EloquentBuilderTrait;

    private $auth;

    private $database;

    private $dispatcher;

    private $userRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        UserRepository $userRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->userRepository = $userRepository;
    }

    public function syncDriver($driverToken, array $data)
    {
        $syncDriver = $this->userRepository->syncDriver($driverToken, $data);

        $driverRepository = new DriverRepository($this->database);
        $driver = $driverRepository->getById($data['driver']['user_id']);
        $driverRepository->update($driver, $data['driver']);

        $tripRepository = new TripRepository($this->database);
        $tripRepository->create($data['trip']);

        $waypointRepository = new WaypointRepository($this->database);
        $waypointRepository->create($data['trip']);

        return $syncDriver;
    }

    public function getAll($options = [])
    {
        return $this->userRepository->get($options);
    }

    public function getById($userId, array $options = [])
    {
        $user = $this->getRequestedUser($userId);

        return $user;
    }

    public function create($data)
    {
        $user = $this->userRepository->create($data);

        $this->dispatcher->fire(new UserWasCreated($user));

        return $user;
    }

    public function update($userId, array $data)
    {
        $user = $this->getRequestedUser($userId);
        $this->database->beginTransaction();

        try {
            $this->userRepository->update($user, $data);
            $this->dispatcher->fire(new UserWasUpdated($user));
        } catch (Exception $e) {
            $this->database->rollBack();

            throw $e;
        }

        $this->database->commit();

        return $user;
    }

    public function delete($userId)
    {
        $user = $this->getRequestedUser($userId);

        $this->userRepository->delete($userId);

        $this->dispatcher->fire(new UserWasDeleted($user));
    }

    private function getRequestedUser($userId)
    {
        $user = $this->userRepository->getById($userId);

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function testAddTrip(array $data)
    {
        /*
        $tripRepository = new TripRepository($this->database);

        return $tripRepository->create($data['trip']);
        */

        $driverRepository = new DriverRepository($this->database);
        $driver = $driverRepository->getById($data['driver']['user_id']);

        return $driverRepository->update($driver, $data['driver']);
    }
}
