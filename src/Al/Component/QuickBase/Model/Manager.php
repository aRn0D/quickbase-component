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

use Al\Component\QuickBase\Request\Builder\Base\BuilderInterface;
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
     * Return the instance of the repository related to $entityName
     *
     * @param  string            $entityName
     * @return Repository
     * @throws \RuntimeException
     */
    public function getRepository($entityName)
    {
        if (!class_exists($entityName)) {
            throw new \RuntimeException(sprintf('Given entity %s does not exist', $entityName));
        }

        if (null === $repository = $this->getRepositoryClassName($entityName)) {
            $repository = 'Al\Component\QuickBase\Model\Repository';
        }

        return new $repository($this);
    }

    /**
     * Create a resource
     *
     * @param $model
     */
    public function create($model)
    {
        $request = $this->builderFactory->get('edition')
            ->createRequest(BuilderInterface::ADD_RECORD)
            ->setModel($model)
            ->setMapping($this->getEntityMapping($model))
            ->getRequest();

        $this->client->send($request);
    }

    /**
     * Update a resource
     *
     * @param $model
     */
    public function update($model)
    {
        $request = $this->builderFactory->get('edition')
            ->createRequest(BuilderInterface::EDIT_RECORD)
            ->setModel($model)
            ->setMapping($this->getEntityMapping($model))
            ->getRequest();

        $this->client->send($request);
    }

    /**
     * Remove a resource
     *
     * @param $model
     */
    public function remove($model)
    {
        $request = $this->builderFactory->get('edition')
            ->createRequest(BuilderInterface::DELETE_RECORD)
            ->setModel($model)
            ->setMapping($this->getEntityMapping($model))
            ->getRequest();

        $this->client->send($request);
    }

    /**
     * Return the class name of the repository
     *
     * @param $modelName
     * @return null|string
     * @throws \RuntimeException
     */
    private function getRepositoryClassName($modelName)
    {
        $repository = null;
        if (isset($this->modelMapping[$modelName])) {
            $repository = $this->modelMapping[$modelName]['repository'];

            if (!class_exists($repository)) {
                throw new \RuntimeException(sprintf('Given repository %s does not exist', $repository));
            }
        }

        return $repository;
    }

    /**
     * Return the mapping of the model
     *
     * @param $model
     * @return array
     * @throws \RuntimeException
     */
    private function getEntityMapping($model)
    {
        if (false === $className = get_class($model)) {
            throw new \RuntimeException('Impossible to get the entity classname');
        }

        $mapping = array();
        if (isset($this->modelMapping[$className]['mapping'])) {
            $mapping = $this->modelMapping[$className]['mapping'];
        }

        return $mapping;
    }
}
