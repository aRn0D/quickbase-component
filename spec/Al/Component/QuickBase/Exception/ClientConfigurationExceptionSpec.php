<?php

namespace spec\Al\Component\QuickBase\Exception;

use PhpSpec\ObjectBehavior;

class ClientConfigurationExceptionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('wrongParam');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Exception\ClientConfigurationException');
    }

    public function it_is_exception()
    {
        $this->shouldHaveType('\Exception');
    }
}
