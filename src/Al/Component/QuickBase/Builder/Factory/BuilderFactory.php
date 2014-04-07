<?php

namespace Al\Component\QuickBase\Builder\Factory;

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
