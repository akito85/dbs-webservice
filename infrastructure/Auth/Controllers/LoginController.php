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
        $password = base64_decode($request->get('password'));
        $password = preg_replace('/-qWERty1234Nox/i', '', $password);
        
        try {
          return $this->response($this->loginProxy->attemptLogin($username, $password));
        }
        catch(\Exception $e) {
          return $this->response(['message' => $e->getMessage(), $e->getCode()]);
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
