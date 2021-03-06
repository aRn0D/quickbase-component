<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Request\Builder\Factory;

use Al\Component\QuickBase\Request\Builder\Base\BuilderInterface;

interface BuilderFactoryInterface
{
    /**
     * Return a instance of a request builder
     *
     * @param  string            $name
     * @return BuilderInterface
     * @throws \RuntimeException
     */
    public function get($name);
}
