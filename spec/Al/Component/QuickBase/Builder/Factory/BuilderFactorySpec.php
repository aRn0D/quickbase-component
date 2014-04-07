<?php

namespace spec\Al\Component\QuickBase\Builder\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BuilderFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Builder\Factory\Builder');
    }

    function it_is_a_factory()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Builder\Factory\BuilderFactoryInterface');
    }

    function it_create_a_builder()
    {
        $this->get('query')->shouldHaveType('Al\Component\QuickBase\Builder\QueryBuilder');
    }
}
