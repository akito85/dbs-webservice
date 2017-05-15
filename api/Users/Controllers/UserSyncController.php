<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Services\UserSyncService;

class UserSyncController extends Controller
{
    private $userSyncService;


    public function _construct(UserSyncService $userSyncService) {
        $this->userSyncService = $userSyncService;
    }

    public function userSync ($driverToken, Request $request) {
        $data = json_decode($request->json(), true);
        $userSync = $this->userSyncService->userSync($driverToken, $data);

        return $this->response($userSync);
    }

    public function testUserSync (Request $request) {
        $data = json_decode($request->json(), true);
        var_dump($data);
    }
}