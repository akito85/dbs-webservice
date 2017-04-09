<?php

namespace Infrastructure\Auth\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Auth\LoginProxy;
use Infrastructure\Auth\Requests\LoginRequest;
use Infrastructure\Http\Controller;

class LoginController extends Controller
{
    private $loginProxy;

    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
    }

    public function login(LoginRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        
        try {
          return $this->response($this->loginProxy->attemptLogin($username, $password));
        }
        catch(\Exception $e) {
          return $this->response(['message' => 'Wrong credentials'], 404);
        }
    }

    public function refresh(Request $request)
    {
        return $this->response($this->loginProxy->attemptRefresh());
    }

    public function logout()
    {
        $this->loginProxy->logout();

        return $this->response(null, 204);
    }
}