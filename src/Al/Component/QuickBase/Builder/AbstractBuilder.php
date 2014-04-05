<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
