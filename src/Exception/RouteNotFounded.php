<?php

namespace Electro\Extra\Exception;

use Exception;

class RouteNotFounded extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}