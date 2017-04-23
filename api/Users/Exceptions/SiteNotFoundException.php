<?php

namespace Api\Users\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SiteNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The site was not found.');
    }
}
