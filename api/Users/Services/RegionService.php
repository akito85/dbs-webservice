<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\RegionNotFoundException;
use Api\Users\Events\RegionWasCreated;
use Api\Users\Events\RegionWasDeleted;
use Api\Users\Events\RegionWasUpdated;
use Api\Users\Repositories\RegionRepository;

class RegionService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $regionRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        RegionRepository $regionRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->regionRepository = $regionRepository;
    }

    public function getAll($options = [])
    {
        return $this->regionRepository->get($options);
    }

    public function getById($regionId, array $options = [])
    {
        $region = $this->getRequestedRegion($regionId);

        return $region;
    }

    public function create($data)
    {
        $region = $this->regionRepository->create($data);

        $this->dispatcher->fire(new RegionWasCreated($region));

        return $region;
    }

    public function update($regionId, array $data)
    {
        $region = $this->getRequestedRegion($regionId);

        $this->regionRepository->update($region, $data);

        $this->dispatcher->fire(new RegionWasUpdated($region));

        return $region;
    }

    public function delete($regionId)
    {
        $region = $this->getRequestedRegion($regionId);

        $this->regionRepository->delete($regionId);

        $this->dispatcher->fire(new RegionWasDeleted($region));
    }

    private function getRequestedRegion($regionId)
    {
        $region = $this->regionRepository->getById($regionId);

        if (is_null($region)) {
            throw new RegionNotFoundException();
        }

        return $region;
    }
}
