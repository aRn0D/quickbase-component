<?php

namespace spec\Al\Component\QuickBase\Query;

use Al\Component\QuickBase\Query\Criteria;
use Al\Component\QuickBase\Query\Query;
use Al\Component\QuickBase\Query\QueryBuilder;
use PhpSpec\ObjectBehavior;

class QueryBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Query\QueryBuilder');
    }

    public function it_create_query()
    {
        $this->createQuery('action')->shouldReturn($this);
    }

    public function it_has_no_query_by_default()
    {
        $this->getQuery()->shouldReturn(null);
    }

    public function it_has_query()
    {
        $this->createQuery('action');
        $this->getQuery()->shouldHaveType('Al\Component\QuickBase\Query\Query');
    }

    public function it_is_a_structured_query()
    {
        $this->createQuery('action')
            ->isStructured(true)
            ->shouldReturn($this);

        $this->getQuery()->getParameters()->shouldReturn(array(
            'fmt' => 'structured'
        ));
    }

    public function it_is_not_a_structured_query()
    {
        $this->createQuery('action')
            ->isStructured(false)
            ->shouldReturn($this);

        $this->getQuery()->getParameters()->shouldReturn(array());
    }

    public function it_select_specifics_columns()
    {
        $this->createQuery('action')
            ->select(array(1, 2))
            ->shouldReturn($this);

        $this->getQuery()->getParameters()->shouldReturn(array(
            'clist' => '1.2'
        ));
    }

    public function it_select_all_columns()
    {
        $this->createQuery('action')
            ->select()->shouldReturn($this);

        $this->getQuery()->getParameters()->shouldReturn(array(
            'clist' => 'a'
        ));
    }

    public function it_add_and_criteria_to_query(Criteria $criteria)
    {
        $criteria->toString()->shouldBeCalled()->willReturn('{something}');

        $this->createQuery('action')
            ->andWhere($criteria)
            ->shouldReturn($this);

        $this->getQuery()->getParameters()->shouldReturn(array(
            'query' => array('AND{something}')
        ));
    }

    public function it_add_or_criteria_to_query(Criteria $criteria)
    {
        $criteria->toString()->shouldBeCalled()->willReturn('{something}');

        $this->createQuery('action')
            ->orWhere($criteria)
            ->shouldReturn($this);

        $this->getQuery()->getParameters()->shouldReturn(array(
            'query' => array('OR{something}')
        ));
    }

    public function it_add_a_criteria_to_query(Criteria $criteria)
    {
        $criteria->toString()->shouldBeCalled()->willReturn('{something}');

        $this->createQuery('action')
            ->where($criteria)
            ->shouldReturn($this);

        $this->getQuery()->getParameters()->shouldReturn(array(
            'query' => array('{something}')
        ));
    }

    public function it_add_limit_to_query()
    {
        $this->createQuery('action')
            ->setLimit(1)
            ->shouldReturn($this);

        $this->getQuery()->getParameters()->shouldReturn(array(
            'options' => array('num-1')
        ));
    }

    public function it_add_offset_to_query()
    {
        $this->createQuery('action')
            ->setOffset(1)
            ->shouldReturn($this);

        $this->getQuery()->getParameters()->shouldReturn(array(
            'options' => array('skp-1')
        ));
    }

    public function it_set_sorting_to_query()
    {
        $this->createQuery('action')
            ->sortBy(array(
                1 => Query::SORT_DESC,
                11 => Query::SORT_ASC
            ))
            ->shouldReturn($this);

        $this->getQuery()->getParameters()->shouldReturn(array(
            'slist' => '1.11',
            'options' => array('sortorder-D.sortorder-A')
        ));
    }
}
