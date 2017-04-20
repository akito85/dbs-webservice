<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateFeedbackRequest;
use Api\Users\Services\FeedbackService;
use Api\Users\Models\Feedback;

class FeedbackController extends Controller
{
    private $feedbackService;

    public function __construct(feedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->feedbackService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'feedbacks');

        return $this->response($parsedData);
    }

    public function getById($feedbackId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->feedbackService->getById($feedbackId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'feedback');

        return $this->response($parsedData);
    }

    public function create(CreateFeedbackRequest $request)
    {
        $data = $request->get('feedback', []);

        return $this->response($this->feedbackService->create($data), 201);
    }

    public function update($feedbackId, Request $request)
    {
        $data = $request->get('feedback', []);

        return $this->response($this->feedbackService->update($feedbackId, $data));
    }

    public function delete($feedbackId)
    {
        return $this->response($this->feedbackService->delete($feedbackId));
    }
}
