<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Builder\Factory;

interface BuilderFactoryInterface
{
    /**
     * Return a instance of a request builder
     *
     * @param string $name
     * @return object
     * @throws \RuntimeException
     */
    public function get($name);
} 