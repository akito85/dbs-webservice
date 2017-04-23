<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateCheckpointRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'checkpoint' => 'array|required',
            'checkpoint.latitude' => 'required',
            'checkpoint.longitude' => 'required',
            'checkpoint.sequence' => 'required',
            'checkpoint.waypoint_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
