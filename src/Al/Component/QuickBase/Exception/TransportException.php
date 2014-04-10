<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Exception;

use Al\Component\QuickBase\Response\Response;
use Exception;

class TransportException extends \Exception
{
    public function __construct(Response $response, \Exception $previous = null)
    {
        $error = $response->getError();

        parent::__construct($error['message'], $error['code'], $previous);
    }
}
