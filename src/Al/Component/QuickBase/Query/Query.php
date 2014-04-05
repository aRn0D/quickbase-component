<?php

namespace Al\Component\QuickBase\Query;

class Query
{
    const OPERATOR_AND = 'AND';
    const OPERATOR_OR = 'OR';

    const SORT_ASC = 'sortorder-A';
    const SORT_DESC = 'sortorder-D';

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $parameters = array();

    public function __construct($action)
    {
        $this->action = $action;
    }

    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param  string $key
     * @return mixed
     */
    public function getParameter($key)
    {
        return $this->parameters[$key];
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function addParameter($name, $value)
    {
        $this->parameters[$name] = $value;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function appendToParameter($name, $value)
    {
        $this->parameters[$name][] = $value;

        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasParameter($key)
    {
        return isset($this->parameters[$key]);
    }

    /**
     * @param  null  $key
     * @return $this
     */
    public function clearParameter($key = null)
    {
        if ($this->hasParameter($key)) {
            unset($this->parameters[$key]);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function clearParameters()
    {
        $this->parameters = array();

        return $this;
    }
}
