<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateRegionRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'region' => 'array|required',
            'region.name' => 'required|string'
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
