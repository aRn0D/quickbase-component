<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Al\Component\QuickBase\Client\TransportAdapter;

use Al\Component\QuickBase\Request\Request;
use GuzzleHttp\ClientInterface;
use PhpSpec\ObjectBehavior;

class GuzzleAdapterSpec extends ObjectBehavior
{
    public function let(ClientInterface $client)
    {
        $this->beConstructedWith($client);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Client\TransportAdapter\GuzzleAdapter');
    }

    public function it_is_http_adapter()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Client\TransportAdapter\TransportAdapterInterface');
    }

    public function it_sends_a_request(Request $request, ClientInterface $client)
    {
        $request->getAction()->shouldBeCalled()->willReturn('action');
        $request->getHost()->shouldBeCalled()->willReturn('http://url.com');
        $request->getBody()->shouldBeCalled()->willReturn('<xml></xml>');

        $client->post(
                'http://url.com',
                array(
                    'headers' => array(
                        'Expect:',
                        'Content-Type: application/xml',
                        'QUICKBASE-ACTION: action',
                    ),
                    'body' => '<xml></xml>'
                )
            )
            ->shouldBeCalled()
            ->willReturn('<qdbapi><errcode>0</errcode></qdbapi>');

        $this->send($request);
    }

    public function it_sends_a_request_but_get_an_error(Request $request, ClientInterface $client)
    {
        $request->getAction()->shouldBeCalled()->willReturn('action');
        $request->getHost()->shouldBeCalled()->willReturn('http://url.com');
        $request->getBody()->shouldBeCalled()->willReturn('<xml></xml>');

        $client->post(
            'http://url.com',
            array(
                'headers' => array(
                    'Expect:',
                    'Content-Type: application/xml',
                    'QUICKBASE-ACTION: action',
                ),
                'body' => '<xml></xml>'
            )
        )
            ->shouldBeCalled()
            ->willReturn('<qdbapi><errcode>75</errcode></qdbapi>');

        $this->shouldThrow('Al\Component\QuickBase\Exception\TransportException')
            ->during('send', array($request));
    }
}
