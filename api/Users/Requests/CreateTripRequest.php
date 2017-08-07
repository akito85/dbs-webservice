<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateTripRequest extends ApiRequest
{
    public function authorize()
    {
         return true;
    }

    public function rules()
    {
        return [
            'trip' => 'array|required',
            'trip.driver_id' => 'required',
            'trip.passenger_id' => 'required',
            // 'trip.information' => 'required',
            'trip.status' => 'required'
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}