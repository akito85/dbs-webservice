<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\SiteNotFoundException;
use Api\Users\Events\SiteWasCreated;
use Api\Users\Events\SiteWasDeleted;
use Api\Users\Events\SiteWasUpdated;
use Api\Users\Repositories\SiteRepository;

class SiteService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $siteRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        UserRepository $siteRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->siteRepository = $siteRepository;
    }

    public function getAll($options = [])
    {
        return $this->siteRepository->get($options);
    }

    public function getById($siteId, array $options = [])
    {
        $site = $this->getRequestedUser($siteId);

        return $site;
    }

    public function create($data)
    {
        $site = $this->siteRepository->create($data);

        $this->dispatcher->fire(new SiteWasCreated($site));

        return $site;
    }

    public function update($siteId, array $data)
    {
        $site = $this->getRequestedUser($siteId);

        $this->siteRepository->update($site, $data);

        $this->dispatcher->fire(new SiteWasUpdated($site));

        return $site;
    }

    public function delete($siteId)
    {
        $site = $this->getRequestedUser($siteId);

        $this->siteRepository->delete($siteId);

        $this->dispatcher->fire(new SiteWasDeleted($site));
    }

    private function getRequestedUser($siteId)
    {
        $site = $this->siteRepository->getById($siteId);

        if (is_null($site)) {
            throw new SiteNotFoundException();
        }

        return $site;
    }
}
