<?php

namespace App\Constants;

use Symfony\Component\HttpFoundation\Response;

class StatusCode
{
    const CREATED = Response::HTTP_CREATED;
    const SUCCESS = Response::HTTP_OK;
    const INTERNAL_SERVER_ERROR = Response::HTTP_INTERNAL_SERVER_ERROR;
    const UNPROCESSABLE_ENTITY = Response::HTTP_UNPROCESSABLE_ENTITY;
}
