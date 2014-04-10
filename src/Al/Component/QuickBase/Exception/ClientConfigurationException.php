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

class ClientConfigurationException extends \Exception
{
    public function __construct($param, $code = 0, \Exception $previous = null)
    {
        parent::__construct(
            sprintf('The parameter %s does not exist', $param),
            $code,
            $previous
        );
    }
}
