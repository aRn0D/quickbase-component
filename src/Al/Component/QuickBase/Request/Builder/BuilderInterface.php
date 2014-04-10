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

interface BuilderInterface
{
    /**
     * @param string $action
     * @return $this
     */
    public function createRequest($action);

    /**
     * @return \Al\Component\QuickBase\Request\Request
     */
    public function getRequest();
} 