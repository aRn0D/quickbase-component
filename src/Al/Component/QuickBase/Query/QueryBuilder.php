<?php

namespace Al\Component\QuickBase\Query;

class QueryBuilder
{
    /**
     * @var Query
     */
    private $query = null;

    /**
     * @param $action
     * @return $this
     */
    public function createQuery($action)
    {
        $this->query = new Query($action);

        return $this;
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Makes the query result structured or not
     *
     * @param  boolean $structured
     * @return $this
     */
    public function isStructured($structured = true)
    {
        $structured ? $this->query->addParameter('fmt', 'structured') : $this->query->clearParameter('fmt');

        return $this;
    }

    /**
     * Select columns in Query
     *
     * @param  array $columns
     * @return $this
     */
    public function select(array $columns = array())
    {
        if (count($columns) == 0) {
            $this->query->addParameter('clist', 'a');
        } else {
            $this->query->addParameter('clist', implode('.', $columns));
        }

        return $this;
    }

    /**
     * Add a new Criteria to the query
     *
     * @param  Criteria $criteria
     * @return $this
     */
    public function where(Criteria $criteria)
    {
        $this->query->appendToParameter('query', $criteria->toString());

        return $this;
    }

    /**
     * Add a new Criteria to the query with or condition
     *
     * @param  Criteria $criteria
     * @return $this
     */
    public function andWhere(Criteria $criteria)
    {
        $this->query->appendToParameter(
            'query',
             Query::OPERATOR_AND . $criteria->toString()
        );

        return $this;
    }

    /**
     * Add a new Criteria to the query with or condition
     *
     * @param  Criteria $criteria
     * @return $this
     */
    public function orWhere(Criteria $criteria)
    {
        $this->query->appendToParameter(
            'query',
            Query::OPERATOR_OR . $criteria->toString()
        );

        return $this;
    }

    /**
     * Modify the starting row
     *
     * @param  integer $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        if (is_integer($offset)) {
            $this->query->appendToParameter('options', 'skp-' . $offset);
        }

        return $this;
    }

    /**
     * Limit the number of rows to return
     *
     * @param  integer $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        if (is_integer($limit)) {
            $this->query->appendToParameter('options', 'num-' . $limit);
        }

        return $this;
    }

    /**
     * Set sorting order for a query
     *
     * @param  array $config Fields to sort on
     * @return $this
     */
    public function sortBy(array $config)
    {
        $this->query->addParameter('slist', implode('.', array_keys($config)));
        $this->query->appendToParameter('options', implode('.', $config));

        return $this;
    }
}
