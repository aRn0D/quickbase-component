<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Al\Component\QuickBase\Client;

use Al\Component\QuickBase\Request\Builder\AuthenticationBuilder;
use Al\Component\QuickBase\Client\TransportAdapter\TransportAdapterInterface;
use Al\Component\QuickBase\Request\Request;
use Al\Component\QuickBase\Response\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    public function let(
        TransportAdapterInterface $client
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
            $client
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
        TransportAdapterInterface $client,
        AuthenticationBuilder $authenticationBuilder,
        Request $request,
        Response $response
    )
    {
        $response->getData('ticket', 'string')
            ->shouldBeCalled()
            ->willReturn('FDSQ3543SGFSD45');

        $response->getData('userid', 'string')
            ->shouldBeCalled()
            ->willReturn('112245.efy7');

        $client ->send(Argument::type('Al\Component\QuickBase\Request\Request'))
            ->shouldBeCalled()
            ->willReturn($response);

        $this->authenticate($authenticationBuilder)->shouldReturn($this);
    }

    public function it_sends_request(
        \Al\Component\QuickBase\Request\Request $request,
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
