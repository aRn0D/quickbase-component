<?php

namespace Al\Component\QuickBase\Model;

use Al\Component\QuickBase\Builder\Query\Criteria;
use Al\Component\QuickBase\Builder\QueryBuilder;

class Repository
{
    /**
     * @var Manager
     */
    protected $manager;

    function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->manager
            ->getBuilderFactory()
            ->get('query');
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function findOneBy(array $criteria = array())
    {
        $queryBuilder = $this->getQueryBuilder()->select();

        $this->addCriteria($queryBuilder, $criteria);

        return $this->manager->getClient()->send($queryBuilder->getRequest());
    }

    /**
     * @param array $criteria
     * @param null $offset
     * @param null $limit
     * @param array $sortBy
     * @return mixed
     */
    public function findBy(array $criteria = array(), $offset = null, $limit = null, array $sortBy = array())
    {
        $queryBuilder = $this->getQueryBuilder()->select()
            ->setLimit($limit)
            ->setOffset($offset)
            ->sortBy($sortBy);

        $this->addCriteria($queryBuilder, $criteria);

        return $this->manager->getClient()->send($queryBuilder->getRequest());
    }

    /**
     * @param QueryBuilder $builder
     * @param array $criteria
     */
    protected function addCriteria(QueryBuilder $builder, array $criteria = array())
    {
        $first = true;
        foreach($criteria as $field => $value) {
            if ($first) {
                $builder->where(new Criteria($field, $value, Criteria::EQUAL));
                $first = false;
            } else {
                $builder->andWhere(new Criteria($field, $value, Criteria::EQUAL));
            }
        }
    }
}
