<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateVehicleRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'vehicle' => 'array|required',
            'vehicle.name' => 'required|string',
            'vehicle.driver_id' => 'required|integer',
            'vehicle.kilometer' => 'required',
            'vehicle.year' => 'required',
            'vehicle.ownership' => 'required|string'
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
