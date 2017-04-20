<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\VehicleNotFoundException;
use Api\Users\Events\VehicleWasCreated;
use Api\Users\Events\VehicleWasDeleted;
use Api\Users\Events\VehicleWasUpdated;
use Api\Users\Repositories\VehicleRepository;

class VehicleService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $vehicleRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        UserRepository $vehicleRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->vehicleRepository = $vehicleRepository;
    }

    public function getAll($options = [])
    {
        return $this->vehicleRepository->get($options);
    }

    public function getById($vehicleId, array $options = [])
    {
        $vehicle = $this->getRequestedUser($vehicleId);

        return $vehicle;
    }

    public function create($data)
    {
        $vehicle = $this->vehicleRepository->create($data);

        $this->dispatcher->fire(new VehicleWasCreated($vehicle));

        return $vehicle;
    }

    public function update($vehicleId, array $data)
    {
        $vehicle = $this->getRequestedUser($vehicleId);

        $this->vehicleRepository->update($vehicle, $data);

        $this->dispatcher->fire(new VehicleWasUpdated($vehicle));

        return $vehicle;
    }

    public function delete($vehicleId)
    {
        $vehicle = $this->getRequestedUser($vehicleId);

        $this->vehicleRepository->delete($vehicleId);

        $this->dispatcher->fire(new VehicleWasDeleted($vehicle));
    }

    private function getRequestedUser($vehicleId)
    {
        $vehicle = $this->vehicleRepository->getById($vehicleId);

        if (is_null($vehicle)) {
            throw new VehicleNotFoundException();
        }

        return $vehicle;
    }
}
