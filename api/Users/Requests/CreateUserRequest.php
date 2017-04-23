<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateUserRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user' => 'array|required',
            'user.password' => 'required|string|min:8',
            'user.email' => 'required|email',
            'user.full_name' => 'required|string',
            'user.gender' => 'required',
            'user.phone_number' => 'required|integer',
            'user.division_id' => 'required',
            'user.requests' => 'required',
            'user.status' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'user.email' => 'the user\'s email'
        ];
    }
}
