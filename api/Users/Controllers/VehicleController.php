<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateVehicleRequest;
use Api\Users\Services\VehicleService;
use Api\Users\Models\Vehicle;

class VehicleController extends Controller
{
    private $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->vehicleService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'vehicles');

        return $this->response($parsedData);
    }

    public function getById($vehicleId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->vehicleService->getById($vehicleId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'vehicle');

        return $this->response($parsedData);
    }

    public function create(CreateVehicleRequest $request)
    {
        $data = $request->get('vehicle', []);

        return $this->response($this->vehicleService->create($data), 201);
    }

    public function update($vehicleId, Request $request)
    {
        $data = $request->get('vehicle', []);

        return $this->response($this->vehicleService->update($vehicleId, $data));
    }

    public function delete($vehicleId)
    {
        return $this->response($this->vehicleService->delete($vehicleId));
    }
}
