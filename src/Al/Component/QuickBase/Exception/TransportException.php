<?php

namespace Al\Component\QuickBase\Exception;

use Al\Component\QuickBase\Client\Response;
use Exception;

class TransportException extends \Exception
{
    public function __construct(Response $response, \Exception $previous = null)
    {
        $error = $response->getError();
        parent::__construct($error['message'], $error['code'], $previous);
    }
}
