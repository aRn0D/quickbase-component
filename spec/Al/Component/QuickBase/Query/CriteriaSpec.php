<?php

namespace spec\Al\Component\QuickBase\Query;

use PhpSpec\ObjectBehavior;

class CriteriaSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1, 'value', 'CT');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Query\Criteria');
    }

    public function it_should_be_transform_as_string()
    {
        $this->toString()->shouldReturn("{'1'.CT.'value'}");
    }
}
