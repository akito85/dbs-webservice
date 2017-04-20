<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateWaypointRequest;
use Api\Users\Services\WaypointService;
use Api\Users\Models\Waypoint;

class WaypointController extends Controller
{
    private $waypointService;

    public function __construct(WaypointService $waypointService)
    {
        $this->waypointService = $waypointService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->waypointService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'waypoints');

        return $this->response($parsedData);
    }

    public function getById($waypointId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->waypointService->getById($waypointId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'waypoint');

        return $this->response($parsedData);
    }

    public function create(CreateWaypointRequest $request)
    {
        $data = $request->get('waypoint', []);

        return $this->response($this->waypointService->create($data), 201);
    }

    public function update($waypointId, Request $request)
    {
        $data = $request->get('waypoint', []);

        return $this->response($this->waypointService->update($waypointId, $data));
    }

    public function delete($waypointId)
    {
        return $this->response($this->waypointService->delete($waypointId));
    }
}
