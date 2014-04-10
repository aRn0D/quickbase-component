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

class BuilderFactory implements BuilderFactoryInterface
{
    /**
     * @param string $name
     * @return object
     * @throws \RuntimeException
     */
    public function get($name)
    {
        $className = sprintf('%s%sBuilder', $this->getRootNameSpace(), ucfirst($name));

        if (!class_exists($className)) {
            throw new \RuntimeException(sprintf('The class %s does not exist', $className));
        }

        return new $className;
    }

    /**
     * @return string
     */
    private function getRootNameSpace()
    {
        $reflection = new \ReflectionClass($this);
        $nameSpace = $reflection->getNamespaceName();

        return str_replace('Factory', '', $nameSpace);
    }
}
