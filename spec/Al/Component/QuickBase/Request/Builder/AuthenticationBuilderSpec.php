<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Al\Component\QuickBase\Request\Builder;

use PhpSpec\ObjectBehavior;

class AuthenticationBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Request\Builder\AuthenticationBuilder');
    }

    public function it_is_a_builder()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Request\Builder\AbstractBuilder');
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
        $this->getRequest()->shouldHaveType('Al\Component\QuickBase\Request\Request');
    }

    public function it_username_is_mutable()
    {
        $this->createRequest('action')
            ->setUsername('username')
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'username' => 'username'
        ));
    }

    public function it_password_is_mutable()
    {
        $this->createRequest('action')
            ->setPassword('password')
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'password' => 'password'
        ));
    }

    public function it_ticket_validitiy_is_mutable()
    {
        $this->createRequest('action')
            ->setTicketValidity(1)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'hours' => 1
        ));
    }

    public function it_message_is_mutable()
    {
        $this->createRequest('action')
            ->setMessage('wellcome')
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'udata' => 'wellcome'
        ));
    }
}
