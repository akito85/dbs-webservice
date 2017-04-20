<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateTripRequest;
use Api\Users\Services\TripService;
use Api\Users\Models\Trip;

class TripController extends Controller
{
    private $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->tripService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'trips');

        return $this->response($parsedData);
    }

    public function getById($tripId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->tripService->getById($tripId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'trip');

        return $this->response($parsedData);
    }

    public function create(CreateTripRequest $request)
    {
        $data = $request->get('trip', []);

        return $this->response($this->tripService->create($data), 201);
    }

    public function update($tripId, Request $request)
    {
        $data = $request->get('trip', []);

        return $this->response($this->tripService->update($tripId, $data));
    }

    public function delete($tripId)
    {
        return $this->response($this->tripService->delete($tripId));
    }
}
