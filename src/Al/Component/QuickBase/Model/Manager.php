<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Model;

use Al\Component\QuickBase\Request\Builder\Factory\BuilderFactoryInterface;
use Al\Component\QuickBase\Client\Client;

class Manager
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var BuilderFactoryInterface
     */
    protected $builderFactory;

    /**
     * @var array
     */
    protected $modelMapping = array();

    public function __construct(
        array $modelMapping,
        Client $client,
        BuilderFactoryInterface $builderFactory
    ) {
        $this->modelMapping = $modelMapping;
        $this->client = $client;
        $this->builderFactory= $builderFactory;
    }

    /**
     * Return the quickbase client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Return the request facotry
     *
     * @return BuilderFactoryInterface
     */
    public function getBuilderFactory()
    {
        return $this->builderFactory;
    }

    /**
     * @param null $entityName
     * @return mixed
     * @throws \RuntimeException
     */
    public function getRepository($entityName = null)
    {
        if (!class_exists($entityName)) {
            throw new \RuntimeException(sprintf('Given entity %s does not exist', $entityName));
        }

        if (null === $repository = $this->getRepositoryClassName($entityName)) {
            $repository = 'Al\Component\QuickBase\Model\Repository';
        }

        return new $repository($this);
    }


    public function create()
    {
        // TODO: write logic here
    }

    public function update()
    {
        // TODO: write logic here
    }

    public function remove()
    {
        // TODO: write logic here
    }

    private function getRepositoryClassName($entityName)
    {
        $repository = null;
        if (isset($this->modelMapping[$entityName])) {
            $repository = $this->modelMapping[$entityName]['repository'];

            if (!class_exists($repository)) {
                throw new \RuntimeException(sprintf('Given repository %s does not exist', $repository));
            }
        }

        return $repository;
    }
}
