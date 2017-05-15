<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateDriverRequest;
use Api\Users\Services\DriverService;
use Api\Users\Models\Driver;

class DriverController extends Controller
{
    private $driverService;

    public function __construct(DriverService $driverService)
    {
        $this->driverService = $driverService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->driverService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'drivers');

        return $this->response($parsedData);
    }

    public function getById($driverId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->driverService->getById($driverId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'driver');

        return $this->response($parsedData);
    }

    public function create(CreateDriverRequest $request)
    {
        $data = $request->get('driver', []);

        return $this->response($this->driverService->create($data), 201);
    }

    public function update($driverId, Request $request)
    {
        $data = $request->get('driver', []);

        return $this->response($this->driverService->update($driverId, $data));
    }

    public function delete($driverId)
    {
        return $this->response($this->driverService->delete($driverId));
    }

    public function syncUser($userToken, Request $request)
    {
        $data = json_decode(json_encode($request->all()), true);
        $syncUser = $this->driverService->syncUser($userToken, $data);

        return $this->response($syncUser);
    }

    public function testSyncUser(Request $request)
    {
        $data = json_decode(json_encode($request->all()), true);

        return $data['notification']['title'];
    }
}
