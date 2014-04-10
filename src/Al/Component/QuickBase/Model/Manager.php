<?php

namespace Al\Component\QuickBase\Model;

use Al\Component\QuickBase\Builder\Factory\BuilderFactoryInterface;
use Al\Component\QuickBase\Client\Client;
use Al\Component\QuickBase\Client\ClientInterface;

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

    public function __construct(Client $client, BuilderFactoryInterface $builderFactory)
    {
        $client->authenticate($builderFactory->get('authentication'));

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
     * TODO : rewrite it...
     *
     * @param null $repository
     * @return mixed
     * @throws \RuntimeException
     */
    public function getRepository($repository = null)
    {
        if (null === $repository) {
            $repository = 'Al\Component\QuickBase\Model\Repository';
        }

        if (!class_exists($repository) || $repository instanceof Repository) {
            throw new \RuntimeException('');
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
}
