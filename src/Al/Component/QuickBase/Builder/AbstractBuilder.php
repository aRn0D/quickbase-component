<?php

namespace Al\Component\QuickBase\Builder;

use Al\Component\QuickBase\Client\Request;

class AbstractBuilder
{
    /**
     * @var Request
     */
    protected $request = null;

    /**
     * @param $action
     * @return $this
     */
    public function createRequest($action)
    {
        $this->request = new Request($action);

        return $this;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
} 