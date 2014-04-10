<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Request\Builder;

use Al\Component\QuickBase\Request\Request;

class AbstractBuilder implements BuilderInterface
{
    /**
     * {@inheritDoc}
     */
    protected $request = null;

    /**
     * {@inheritDoc}
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
