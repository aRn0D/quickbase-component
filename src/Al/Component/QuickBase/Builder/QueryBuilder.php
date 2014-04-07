<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Builder;

use Al\Component\QuickBase\Builder\Query\Criteria;

class QueryBuilder extends AbstractBuilder
{
    const OPERATOR_AND = 'AND';
    const OPERATOR_OR = 'OR';

    const SORT_ASC = 'sortorder-A';
    const SORT_DESC = 'sortorder-D';

    /**
     * Makes the query result structured or not
     *
     * @param  boolean $structured
     * @return $this
     */
    public function isStructured($structured = true)
    {
        $structured ? $this->request->addParameter('fmt', 'structured') : $this->request->clearParameter('fmt');

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
            $this->request->addParameter('clist', 'a');
        } else {
            $this->request->addParameter('clist', implode('.', $columns));
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
        $this->request->appendToParameter('query', $criteria->toString());

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
        $this->request->appendToParameter(
            'query',
             self::OPERATOR_AND . $criteria->toString()
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
        $this->request->appendToParameter(
            'query',
            self::OPERATOR_OR . $criteria->toString()
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
            $this->request->appendToParameter('options', 'skp-' . $offset);
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
            $this->request->appendToParameter('options', 'num-' . $limit);
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
        if (count($config) > 0) {
            $this->request->addParameter('slist', implode('.', array_keys($config)));
            $this->request->appendToParameter('options', implode('.', $config));
        }

        return $this;
    }
}
