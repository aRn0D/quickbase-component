<?php

namespace spec\Al\Component\QuickBase\Exception;

use Al\Component\QuickBase\Client\Response;
use PhpSpec\ObjectBehavior;

class TransportExceptionSpec extends ObjectBehavior
{
    public function let(Response $response)
    {
        $response->getError()->shouldBeCalled()->willReturn(array(
            'message' => 'message',
            'code' => 75
        ));

        $this->beConstructedWith($response);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Exception\TransportException');
    }

    public function it_an_exception()
    {
        $this->shouldHaveType('\Exception');
    }
}
