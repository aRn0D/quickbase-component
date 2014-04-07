<?php

namespace Al\Component\QuickBase\Client\HttpAdapter;

use Al\Component\QuickBase\Client\Request;
use GuzzleHttp\ClientInterface;

class GuzzleAdapter implements HttpAdapterInterface
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
    public function getClient()
    {
        return $this->client;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Request $request)
    {
        $response = $this->client->post(
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

        return $response;
    }


}
