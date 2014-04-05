<?php

namespace spec\Al\Component\QuickBase\Builder;

use Al\Component\QuickBase\Builder\QueryBuilder;
use Al\Component\QuickBase\Builder\Query\Criteria;
use PhpSpec\ObjectBehavior;

class QueryBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Builder\QueryBuilder');
    }

    function it_is_a_builder()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Builder\AbstractBuilder');
    }

    public function it_create_request()
    {
        $this->createRequest('action')->shouldReturn($this);
    }

    public function it_has_no_request_by_default()
    {
        $this->getRequest()->shouldReturn(null);
    }

    public function it_has_request()
    {
        $this->createRequest('action');
        $this->getRequest()->shouldHaveType('Al\Component\QuickBase\Client\Request');
    }

    public function it_is_a_structured_query()
    {
        $this->createRequest('action')
            ->isStructured(true)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'fmt' => 'structured'
        ));
    }

    public function it_is_not_a_structured_query()
    {
        $this->createRequest('action')
            ->isStructured(false)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array());
    }

    public function it_select_specifics_columns()
    {
        $this->createRequest('action')
            ->select(array(1, 2))
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'clist' => '1.2'
        ));
    }

    public function it_select_all_columns()
    {
        $this->createRequest('action')
            ->select()->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'clist' => 'a'
        ));
    }

    public function it_add_and_criteria_to_query(\Al\Component\QuickBase\Builder\Query\Criteria $criteria)
    {
        $criteria->toString()->shouldBeCalled()->willReturn('{something}');

        $this->createRequest('action')
            ->andWhere($criteria)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'query' => array('AND{something}')
        ));
    }

    public function it_add_or_criteria_to_query(\Al\Component\QuickBase\Builder\Query\Criteria $criteria)
    {
        $criteria->toString()->shouldBeCalled()->willReturn('{something}');

        $this->createRequest('action')
            ->orWhere($criteria)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'query' => array('OR{something}')
        ));
    }

    public function it_add_a_criteria_to_query(Criteria $criteria)
    {
        $criteria->toString()->shouldBeCalled()->willReturn('{something}');

        $this->createRequest('action')
            ->where($criteria)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'query' => array('{something}')
        ));
    }

    public function it_add_limit_to_query()
    {
        $this->createRequest('action')
            ->setLimit(1)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'options' => array('num-1')
        ));
    }

    public function it_add_offset_to_query()
    {
        $this->createRequest('action')
            ->setOffset(1)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'options' => array('skp-1')
        ));
    }

    public function it_set_sorting_to_query()
    {
        $this->createRequest('action')
            ->sortBy(array(
                1 => QueryBuilder::SORT_DESC,
                11 => QueryBuilder::SORT_ASC
            ))
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'slist' => '1.11',
            'options' => array('sortorder-D.sortorder-A')
        ));
    }
}