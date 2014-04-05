<?php

namespace Al\Component\QuickBase\Query;

class Criteria
{
    const CONTAINS = 'CT';
    const NOT_CONTAINS = 'XCT';
    const USER_HAS = 'HAS';
    const USER_HAS_NOT = 'XHAS';
    const EQUAL = 'EX';
    const NOT_EQUAL = 'XEX';
    const GREATER_EQUAL = 'GTE';
    const GREATER_THAN = 'GT';
    const LOWER_EQUAL = 'LTE';
    const LOWER_THAN = 'LT';
    const NOT_STARTS_WITH = 'XSW';
    const STARTS_WITH = 'SW';
    const IS_BEFORE = 'BF';
    const IS_ON_OR_BEFORE = 'OBF';
    const IS_AFTER = 'AF';
    const IS_ON_OR_AFTER = 'OAF';
    const IS_DURING = 'IR';
    const IS_NOT_DURING = 'OIR';

    /**
     * @var integer
     */
    protected $column;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $operator;

    public function __construct($column, $value, $operator = self::EQUAL)
    {
        if ($value instanceof \DateTime) {
            $value = $this->getDate($value);
        }

        $this->column = $column;
        $this->value = $value;
        $this->operator = $operator;
    }

    /**
     * Returns a Quickbase interpretable criteria
     *
     * @return string
     */
    public function toString()
    {
        return sprintf(
            "{'%s'.%s.'%s'}",
            $this->column,
            $this->operator,
            $this->value
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Returns a timestamp compatible with Quickbase
     *
     * @return integer
     * @param  \DateTime $dt
     */
    protected function getDate(\DateTime $dt)
    {
        return (string) $dt->format('U') * 1000;
    }
}
