<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Al\Component\QuickBase\Client\HttpAdapter;

use Al\Component\QuickBase\Client\Request;
use GuzzleHttp\ClientInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GuzzleAdapterSpec extends ObjectBehavior
{
    function let(ClientInterface $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Client\HttpAdapter\GuzzleAdapter');
    }

    function it_is_http_adapter()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Client\HttpAdapter\HttpAdapterInterface');
    }

    function it_sends_a_request(Request $request, ClientInterface $client)
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
        )->shouldBeCalled();

        $this->send($request);
    }
}
