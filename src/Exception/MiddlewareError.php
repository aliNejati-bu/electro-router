<?php

namespace Electro\Extra\Exception;

class MiddlewareError extends \Exception
{
    public function __construct($m)
    {
        parent::__construct('middleware error: ' . $m);
    }
}