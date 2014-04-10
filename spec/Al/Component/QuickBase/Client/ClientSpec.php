<?php

namespace spec\Al\Component\QuickBase\Client;

use Al\Component\QuickBase\Builder\AuthenticationBuilder;
use Al\Component\QuickBase\Builder\Factory\BuilderFactoryInterface;
use Al\Component\QuickBase\Client\TransportAdapter\TransportAdapterInterface;
use Al\Component\QuickBase\Client\Request;
use Al\Component\QuickBase\Client\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    public function let(
        TransportAdapterInterface $client,
        BuilderFactoryInterface $builderFactory
    ) {
        $this->beConstructedWith(
            array(
                'host' => 'http://url.com',
                'username' => 'user',
                'password' => 'password',
                'ticket_life_time_in_hours' => 10,
                'message' => 'Welcome',
                'token' => '1425454fdsq5q4g5f',
                'cached_ticket' => __DIR__.'/ticket'
            ),
            $client,
            $builderFactory
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Client\Client');
    }

    function it_has_no_a_ticket_by_defautt()
    {
        $this->getTicket()->shouldReturn(null);
    }

    function it_has_transport_adapter()
    {
        $this->getTransportAdapter()->shouldHaveType('Al\Component\QuickBase\Client\TransportAdapter\TransportAdapterInterface');
    }

    public function it_gets_ticket_from_quickbase(
        BuilderFactoryInterface $builderFactory,
        TransportAdapterInterface $client,
        AuthenticationBuilder $authenticationBuilder,
        Request $request,
        Response $response
    )
    {
        $authenticationBuilder->setUsername('user')
            ->shouldBeCalled()
            ->willReturn($authenticationBuilder);

        $authenticationBuilder->setPassword('password')
            ->shouldBeCalled()
            ->willReturn($authenticationBuilder);

        $authenticationBuilder->setTicketValidity(10)
            ->shouldBeCalled()
            ->willReturn($authenticationBuilder);

        $authenticationBuilder->setMessage('Welcome')
            ->shouldBeCalled()
            ->willReturn($authenticationBuilder);

        $authenticationBuilder->getRequest()
            ->shouldBeCalled()
            ->willReturn($request);

        $response->getData('ticket', 'string')
            ->shouldBeCalled()
            ->willReturn('FDSQ3543SGFSD45');

        $client ->send($request)
            ->shouldBeCalled()
            ->willReturn($response);

        $builderFactory->get('authentication')
            ->willReturn($authenticationBuilder);

        $this->authenticate()->shouldReturn($this);
    }

    public function it_sends_request(
        Request $request,
        TransportAdapterInterface $transportAdapter
    )
    {
        $request->setHost('http://url.com')
            ->shouldBeCalled()
            ->willReturn($request);

        $request->setToken('1425454fdsq5q4g5f')
            ->shouldBeCalled()
            ->willReturn($request);

        $transportAdapter->send($request)
            ->shouldBeCalled();

        $this->send($request)->shouldHaveType('Al\Component\QuickBase\Client\Response');
    }
}
