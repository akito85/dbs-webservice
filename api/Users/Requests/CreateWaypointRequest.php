<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateWaypointRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'waypoint' => 'array|required',
            'waypoint.trip_id' => 'required|integer',
            'waypoint.mileage' => 'required',
            'waypoint.start_time' => 'required',
            'waypoint.end_time' => 'required',
            'waypoint.pickup_location' => 'required',
            'waypoint.pickup_lat' => 'required',
            'waypoint.pickup_lng' => 'required',
            'waypoint.dropoff_location' => 'required',
            'waypoint.dropoff_lat' => 'required',
            'waypoint.dropoff_lng' => 'required',
            'waypoint.sequence' => 'required'
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
