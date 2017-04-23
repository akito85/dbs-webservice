<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateDivisionRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'division' => 'array|required',
            'division.site_id' => 'required|integer',
            'division.name' => 'required|string'
        ];
    }

    public function attributes()
    {
        return [

        ];
      }
}
