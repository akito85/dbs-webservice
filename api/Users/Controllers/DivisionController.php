<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateDivisionRequest;
use Api\Users\Services\DivisionService;
use Api\Users\Models\Division;

class DivisionController extends Controller
{
    private $divisionService;

    public function __construct(DivisionService $divisionService)
    {
        $this->divisionService = $divisionService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->divisionService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'divisions');

        return $this->response($parsedData);
    }

    public function getById($divisionId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->divisionService->getById($divisionId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'division');

        return $this->response($parsedData);
    }

    public function create(CreateDivisionRequest $request)
    {
        $data = $request->get('division', []);

        return $this->response($this->divisionService->create($data), 201);
    }

    public function update($divisionId, Request $request)
    {
        $data = $request->get('division'
            , []);

        return $this->response($this->divisionService->update($divisionId, $data));
    }

    public function delete($divisionId)
    {
        return $this->response($this->divisionService->delete($divisionId));
    }
}
