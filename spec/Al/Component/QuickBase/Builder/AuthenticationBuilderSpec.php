<?php

namespace spec\Al\Component\QuickBase\Builder;

use Al\Component\QuickBase\Client\Client;
use Al\Component\QuickBase\Query\QueryBuilder;
use PhpSpec\ObjectBehavior;

class AuthenticationBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Builder\AuthenticationBuilder');
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

    function it_username_is_mutable()
    {
        $this->createRequest('action')
            ->setUsername('username')
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'username' => 'username'
        ));
    }

    function it_password_is_mutable()
    {
        $this->createRequest('action')
            ->setPassword('password')
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'password' => 'password'
        ));
    }

    function it_ticket_validitiy_is_mutable()
    {
        $this->createRequest('action')
            ->setTicketValidity(1)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'hours' => 1
        ));
    }

    function it_message_is_mutable()
    {
        $this->createRequest('action')
            ->setMessage('wellcome')
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'udata' => 'wellcome'
        ));
    }
}
