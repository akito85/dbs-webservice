<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\DivisionNotFoundException;
use Api\Users\Events\DivisionWasCreated;
use Api\Users\Events\DivisionWasDeleted;
use Api\Users\Events\DivisionWasUpdated;
use Api\Users\Repositories\DivisionRepository;

class DivisionService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $divisionRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        DivisionRepository $divisionRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->divisionRepository = $divisionRepository;
    }

    public function getAll($options = [])
    {
        return $this->divisionRepository->get($options);
    }

    public function getById($divisionId, array $options = [])
    {
        $division = $this->getRequestedDivision($divisionId);

        return $division;
    }

    public function create($data)
    {
        $division = $this->divisionRepository->create($data);

        $this->dispatcher->fire(new DivisionWasCreated($division));

        return $division;
    }

    public function update($divisionId, array $data)
    {
        $division = $this->getRequestedDivision($divisionId);

        $this->divisionRepository->update($division, $data);

        $this->dispatcher->fire(new DivisionWasUpdated($division));

        return $division;
    }

    public function delete($divisionId)
    {
        $division = $this->getRequestedDivision($divisionId);

        $this->divisionRepository->delete($divisionId);

        $this->dispatcher->fire(new DivisionWasDeleted($division));
    }

    private function getRequestedDivision($divisionId)
    {
        $division = $this->divisionRepository->getById($divisionId);

        if (is_null($division)) {
            throw new DivisionNotFoundException();
        }

        return $division;
    }
}
