<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\CheckpointNotFoundException;
use Api\Users\Events\CheckpointWasCreated;
use Api\Users\Events\CheckpointWasDeleted;
use Api\Users\Events\CheckpointWasUpdated;
use Api\Users\Repositories\CheckpointRepository;

class CheckpointService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $checkpointRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        UserRepository $checkpointRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->checkpointRepository = $checkpointRepository;
    }

    public function getAll($options = [])
    {
        return $this->checkpointRepository->get($options);
    }

    public function getById($checkpointId, array $options = [])
    {
        $checkpoint = $this->getRequestedUser($checkpointId);

        return $checkpoint;
    }

    public function create($data)
    {
        $checkpoint = $this->checkpointRepository->create($data);

        $this->dispatcher->fire(new CheckpointWasCreated($checkpoint));

        return $checkpoint;
    }

    public function update($checkpointId, array $data)
    {
        $checkpoint = $this->getRequestedUser($checkpointId);

        $this->checkpointRepository->update($checkpoint, $data);

        $this->dispatcher->fire(new CheckpointWasUpdated($checkpoint));

        return $checkpoint;
    }

    public function delete($checkpointId)
    {
        $checkpoint = $this->getRequestedUser($checkpointId);

        $this->checkpointRepository->delete($checkpointId);

        $this->dispatcher->fire(new CheckpointWasDeleted($checkpoint));
    }

    private function getRequestedUser($checkpointId)
    {
        $checkpoint = $this->checkpointRepository->getById($checkpointId);

        if (is_null($checkpoint)) {
            throw new CheckpointNotFoundException();
        }

        return $checkpoint;
    }
}
