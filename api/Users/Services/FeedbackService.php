<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\FeedbackNotFoundException;
use Api\Users\Events\FeedbackWasCreated;
use Api\Users\Events\FeedbackWasDeleted;
use Api\Users\Events\FeedbackWasUpdated;
use Api\Users\Repositories\FeedbackRepository;

class FeedbackService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $feedbackRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        FeedbackRepository $feedbackRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->feedbackRepository = $feedbackRepository;
    }

    public function getAll($options = [])
    {
        return $this->feedbackRepository->get($options);
    }

    public function getById($feedbackId, array $options = [])
    {
        $feedback = $this->getRequestedFeedback($feedbackId);

        return $feedback;
    }

    public function create($data)
    {
        $feedback = $this->feedbackRepository->create($data);

        $this->dispatcher->fire(new FeedbackWasCreated($feedback));

        return $feedback;
    }

    public function update($feedbackId, array $data)
    {
        $feedback = $this->getRequestedFeedback($feedbackId);

        $this->feedbackRepository->update($feedback, $data);

        $this->dispatcher->fire(new FeedbackWasUpdated($feedback));

        return $feedback;
    }

    public function delete($feedbackId)
    {
        $feedback = $this->getRequestedFeedback($feedbackId);

        $this->feedbackRepository->delete($feedbackId);

        $this->dispatcher->fire(new FeedbackWasDeleted($feedback));
    }

    private function getRequestedFeedback($feedbackId)
    {
        $feedback = $this->feedbackRepository->getById($feedbackId);

        if (is_null($feedback)) {
            throw new FeedbackNotFoundException();
        }

        return $feedback;
    }
}
