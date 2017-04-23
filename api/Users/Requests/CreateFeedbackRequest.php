<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateFeedbackRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'feedback' => 'array|required',
            'feedback.trip_id' => 'required|integer',
            'feedback.rating' => 'required|integer',
            'feedback.comment' => 'required|string'
        ];
    }

    public function attributes()
    {
        return [

        ];
    }
}
