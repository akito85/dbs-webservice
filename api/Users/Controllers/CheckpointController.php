<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateCheckpointRequest;
use Api\Users\Services\CheckpointService;
use Api\Users\Models\Checkpoint;

class CheckpointController extends Controller
{
    private $checkpointService;

    public function __construct(CheckpointService $checkpointService)
    {
        $this->checkpointService = $checkpointService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->checkpointService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'checkpoints');

        return $this->response($parsedData);
    }

    public function getById($checkpointId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->checkpointService->getById($checkpointId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'checkpoint');

        return $this->response($parsedData);
    }

    public function create(CreateCheckpointRequest $request)
    {
        $data = $request->get('checkpoint', []);

        return $this->response($this->checkpointService->create($data), 201);
    }

    public function update($checkpointId, Request $request)
    {
        $data = $request->get('checkpoint', []);

        return $this->response($this->checkpointService->update($checkpointId, $data));
    }

    public function delete($checkpointId)
    {
        return $this->response($this->checkpointService->delete($checkpointId));
    }
}
