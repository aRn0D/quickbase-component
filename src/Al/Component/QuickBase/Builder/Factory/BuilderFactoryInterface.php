<?php

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