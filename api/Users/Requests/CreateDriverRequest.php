<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateDriverRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'driver' => 'array|required',
            'driver.user_id' => 'required',
            'driver.status' => 'required',
            'driver.latitude' => 'required',
            'driver.longitude' => 'required'
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
