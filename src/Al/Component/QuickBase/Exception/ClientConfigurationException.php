<?php

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
