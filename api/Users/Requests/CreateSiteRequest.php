<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateSiteRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'site' => 'array|required',
            'site.name' => 'required|string',
            'site.latitude' => 'required',
            'site.longitude' => 'required',
            'site.region_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
