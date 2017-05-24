<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Optimus\Bruno\EloquentBuilderTrait;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateUserRequest;
use Api\Users\Services\UserService;

class UserController extends Controller
{
    use EloquentBuilderTrait;

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getAll($resourceOptions);

        $parsedData = $this->parseData($data, $resourceOptions, 'users');

        return $this->response($parsedData);
    }

    public function getById($userId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getById($userId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'user');

        return $this->response($parsedData);
    }

    public function create(CreateUserRequest $request)
    {
        $data = $request->get('user', []);

        return $this->response($this->userService->create($data), 201);
    }

    public function update($userId, Request $request)
    {
        $data = $request->get('user', []);

        return $this->response($this->userService->update($userId, $data));
    }

    public function delete($userId)
    {
        return $this->response($this->userService->delete($userId));
    }

    public function syncDriver($driverToken, Request $request)
    {
        $data = json_decode(json_encode($request->all()), true);
        $syncDriver = $this->userService->syncDriver($driverToken, $data);

        return $this->response($syncDriver);
    }

    public function testSyncDriver(Request $request)
    {
        $data = json_decode(json_encode($request->all()), true);

        return $data['notification']['title'];
    }

    public function testAddTrip(Request $request)
    {
        $data = json_decode(json_encode($request->all()), true);

        return $this->userService->testAddTrip($data);
    }
}
