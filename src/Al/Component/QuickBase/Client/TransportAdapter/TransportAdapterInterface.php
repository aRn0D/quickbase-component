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

use Al\Component\QuickBase\Request\Request;
use Al\Component\QuickBase\Response\Response;

interface TransportAdapterInterface
{
    /**
     * Send a request to quickbase
     *
     * @param  Request  $request
     * @return Response
     */
    public function send(Request $request);
}
