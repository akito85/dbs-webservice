<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\TripNotFoundException;
use Api\Users\Events\TripWasCreated;
use Api\Users\Events\TripWasDeleted;
use Api\Users\Events\TripWasUpdated;
use Api\Users\Repositories\TripRepository;

class TripService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $tripRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        TripRepository $tripRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->tripRepository = $tripRepository;
    }

    public function getAll($options = [])
    {
        return $this->tripRepository->get($options);
    }

    public function getById($tripId, array $options = [])
    {
        $trip = $this->getRequestedTrip($tripId);

        return $trip;
    }

    public function create($data)
    {
        $trip = $this->tripRepository->create($data);

        $this->dispatcher->fire(new TripWasCreated($trip));

        return $trip;
    }

    public function update($tripId, array $data)
    {
        $trip = $this->getRequestedTrip($tripId);

        $this->tripRepository->update($trip, $data);

        $this->dispatcher->fire(new TripWasUpdated($trip));

        return $trip;
    }

    public function delete($tripId)
    {
        $trip = $this->getRequestedTrip($tripId);

        $this->tripRepository->delete($tripId);

        $this->dispatcher->fire(new TripWasDeleted($trip));
    }

    private function getRequestedTrip($tripId)
    {
        $trip = $this->tripRepository->getById($tripId);

        if (is_null($trip)) {
            throw new TripNotFoundException();
        }

        return $trip;
    }
}
