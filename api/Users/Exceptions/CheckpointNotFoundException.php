<?php

namespace Api\Users\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckpointNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The checkpoint was not found.');
    }
}
