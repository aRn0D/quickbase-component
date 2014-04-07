<?php


namespace Al\Component\QuickBase\Client\HttpAdapter;

use Al\Component\QuickBase\Client\Request;

interface HttpAdapterInterface
{
    /**
     * Send a request to quickbase
     *
     * @param Request $request
     * @return mixed
     */
    public function send(Request $request);

    /**
     * Return the client instance
     *
     * @return object
     */
    public function getClient();
} 