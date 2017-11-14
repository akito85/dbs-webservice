<?php

namespace Infrastructure\Auth;

use Illuminate\Foundation\Application;
use Infrastructure\Auth\Exceptions\InvalidCredentialsException;
use Api\Users\Repositories\UserRepository;

class LoginProxy
{
    const REFRESH_TOKEN = 'refreshToken';

    private $apiConsumer;

    private $auth;

    private $cookie;

    private $db;

    private $request;

    private $userRepository;

    public function __construct(Application $app, UserRepository $userRepository) {
        $this->userRepository = $userRepository;

        $this->apiConsumer = $app->make('apiconsumer');
        $this->auth = $app->make('auth');
        $this->cookie = $app->make('cookie');
        $this->db = $app->make('db');
        $this->request = $app->make('request');
    }

    /**
     * Attempt to create an access token using user credentials
     *
     * @param string $username
     * @param string $password
     */
    public function attemptLogin($username, $password)
    {
        $user = $this->userRepository->getWhere('username', $username)->first();

        if (!is_null($user)) {
            if (!$user->deleted) {
                return $this->proxy('password', [
                    'username' => $username,
                    'password' => $password,
                    'access_level' => $user->access_level,
                    'user_id' => $user->id,
                    'division_id' => $user->division_id
                ]);
            } else {
                return json_encode(['message' => 'User is not available']);
            }
        }
        throw new InvalidCredentialsException();
    }

    /**
     * Attempt to refresh the access token used a refresh token that 
     * has been saved in a cookie
     */
    public function attemptRefresh()
    {
        $refreshToken = $this->request->cookie(self::REFRESH_TOKEN);

        return $this->proxy('refresh_token', [
            'refresh_token' => $refreshToken
        ]);
    }

    /**
     * Proxy a request to the OAuth server.
     * 
     * @param string $grantType what type of grant type should be proxied
     * @param array $data the data to send to the server
     */
    public function proxy($grantType, array $data = [])
    {
        $data = array_merge($data, [
            'client_id'     => env('PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSWORD_CLIENT_SECRET'),
            'grant_type'    => $grantType
        ]);
        
        $response = $this->apiConsumer->post('/oauth/token', $data);

        if (!$response->isSuccessful()) {
            throw new InvalidCredentialsException();
        }

        $response = json_decode($response->getContent());

        // Create a refresh token cookie
        $this->cookie->queue(
            self::REFRESH_TOKEN,
            $response->refresh_token,
            2628000, // 5years
            null,
            null,
            false,
            true // HttpOnly
        );

        return [
            'user_id' => $data['user_id'],
            'division_id' => $data['division_id'],
            'access_level' => $data['access_level'],
            'access_token' => $response->access_token,
            'expires_in' => $response->expires_in
        ];
    }

    /**
     * Logs out the user. We revoke access token and refresh token. 
     * Also instruct the client to forget the refresh cookie.
     */
    public function logout()
    {
        $accessToken = $this->auth->user()->token();

        $refreshToken = $this->db
            ->table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        $this->cookie->queue($this->cookie->forget(self::REFRESH_TOKEN));
    }
}
