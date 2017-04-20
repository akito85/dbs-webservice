<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\WaypointNotFoundException;
use Api\Users\Events\WaypointWasCreated;
use Api\Users\Events\WaypointWasDeleted;
use Api\Users\Events\WaypointWasUpdated;
use Api\Users\Repositories\WaypointRepository;

class WaypointService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $waypointRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        UserRepository $waypointRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->waypointRepository = $waypointRepository;
    }

    public function getAll($options = [])
    {
        return $this->waypointRepository->get($options);
    }

    public function getById($waypointId, array $options = [])
    {
        $waypoint = $this->getRequestedUser($waypointId);

        return $waypoint;
    }

    public function create($data)
    {
        $waypoint = $this->waypointRepository->create($data);

        $this->dispatcher->fire(new WaypointWasCreated($waypoint));

        return $waypoint;
    }

    public function update($waypointId, array $data)
    {
        $waypoint = $this->getRequestedUser($waypointId);

        $this->waypointRepository->update($waypoint, $data);

        $this->dispatcher->fire(new WaypointWasUpdated($waypoint));

        return $waypoint;
    }

    public function delete($waypointId)
    {
        $waypoint = $this->getRequestedUser($waypointId);

        $this->waypointRepository->delete($waypointId);

        $this->dispatcher->fire(new WaypointWasDeleted($waypoint));
    }

    private function getRequestedUser($waypointId)
    {
        $waypoint = $this->waypointRepository->getById($waypointId);

        if (is_null($waypoint)) {
            throw new WaypointNotFoundException();
        }

        return $waypoint;
    }
}
