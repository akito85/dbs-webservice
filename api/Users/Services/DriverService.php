<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\DriverNotFoundException;
use Api\Users\Events\DriverWasCreated;
use Api\Users\Events\DriverWasDeleted;
use Api\Users\Events\DriverWasUpdated;
use Api\Users\Repositories\DriverRepository;

class DriverService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $driverRepository;

    public function __construct(
      AuthManager $auth,
      DatabaseManager $database,
      Dispatcher $dispatcher,
      DriverRepository $driverRepository
    ) {
      $this->auth = $auth;
      $this->database = $database;
      $this->dispatcher = $dispatcher;
      $this->driverRepository = $driverRepository;
    }

    public function syncUser($userToken, array $data)
    {
        $syncUser = $this->driverRepository->syncUser($userToken, $data);

        return $syncUser;
    }

    public function getAll($options = [])
    {
      return $this->driverRepository->get($options);
    }

    public function getById($driverId, array $options = [])
    {
      $driver = $this->getRequestedDriver($driverId);

      return $driver;
    }

    public function create($data)
    {
      $driver = $this->driverRepository->create($data);

      $this->dispatcher->fire(new DriverWasCreated($driver));

      return $driver;
    }

    public function update($driverId, array $data)
    {
      $driver = $this->getRequestedDriver($driverId);

      $this->driverRepository->update($driver, $data);

      $this->dispatcher->fire(new DriverWasUpdated($driver));

      return $driver;
    }

    public function delete($driverId)
    {
      $driver = $this->getRequestedDriver($driverId);

      $this->driverRepository->delete($driverId);

      $this->dispatcher->fire(new DriverWasDeleted($driver));
    }

    private function getRequestedDriver($driverId)
    {
      $driver = $this->driverRepository->getById($driverId);

      if (is_null($driver)) {
        throw new DriverNotFoundException();
      }

      return $driver;
    }
}
