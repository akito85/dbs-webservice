<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateRegionRequest;
use Api\Users\Services\RegionService;
use Api\Users\Models\Region;

class RegionController extends Controller
{
    private $regionService;

    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->regionService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'regions');

        return $this->response($parsedData);
    }

    public function getById($regionId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->regionService->getById($regionId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'region');

        return $this->response($parsedData);
    }

    public function create(CreateRegionRequest $request)
    {
        $data = $request->get('region', []);

        return $this->response($this->regionService->create($data), 201);
    }

    public function update($regionId, Request $request)
    {
        $data = $request->get('region', []);

        return $this->response($this->regionService->update($regionId, $data));
    }

    public function delete($regionId)
    {
        return $this->response($this->regionService->delete($regionId));
    }
}
