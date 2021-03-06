<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Request\Builder\Base;

use Al\Component\QuickBase\Request\Request;

class AbstractBuilder implements BuilderInterface
{
    /**
     * @var Request
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

    /**
     * Makes the query result structured or not
     *
     * @param  boolean $structured
     * @return $this
     */
    public function setStructured($structured = true)
    {
        if ($structured) {
            $this->getRequest()->addParameter('fmt', 'structured');
        } else {
            $this->getRequest()->clearParameter('fmt');
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isStructured()
    {
        $fmt = $this->getRequest()->getParameter('fmt');

        return 'structured' == $fmt;
    }
}
