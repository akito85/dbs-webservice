<?php

namespace Api\Users\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FeedbackNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The feedback was not found.');
    }
}
