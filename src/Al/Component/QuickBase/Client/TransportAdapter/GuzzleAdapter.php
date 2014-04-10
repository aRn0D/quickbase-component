<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Client\TransportAdapter;

use Al\Component\QuickBase\Client\Request;
use Al\Component\QuickBase\Client\Response;
use Al\Component\QuickBase\Exception\TransportException;
use GuzzleHttp\ClientInterface;

class GuzzleAdapter implements TransportAdapterInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Request $request)
    {
        $clientResponse = $this->client->post(
            $request->getHost(),
            array(
                'headers' => array(
                    'Expect:',
                    'Content-Type: application/xml',
                    'QUICKBASE-ACTION: ' . $request->getAction(),
                ),
                'body' => $request->getBody(),
            )
        );

        $response = new Response($clientResponse);

        if ($response->isErrored()) {
            throw new TransportException($response);
        }

        return $response;
    }
}
