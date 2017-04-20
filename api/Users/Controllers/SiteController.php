<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateSiteRequest;
use Api\Users\Services\SiteService;
use Api\Users\Models\Site;

class SiteController extends Controller
{
    private $siteService;

    public function __construct(SiteService $siteService)
    {
        $this->siteService = $siteService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->siteService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'sites');

        return $this->response($parsedData);
    }

    public function getById($siteId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->siteService->getById($siteId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'site');

        return $this->response($parsedData);
    }

    public function create(CreateSiteRequest $request)
    {
        $data = $request->get('site', []);

        return $this->response($this->siteService->create($data), 201);
    }

    public function update($siteId, Request $request)
    {
        $data = $request->get('site', []);

        return $this->response($this->siteService->update($siteId, $data));
    }

    public function delete($siteId)
    {
        return $this->response($this->siteService->delete($siteId));
    }
}
