<?php

namespace Api\Users\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegionNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The region was not found.');
    }
}
