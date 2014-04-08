<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Client\HttpAdapter;

use Al\Component\QuickBase\Client\Request;
use Al\Component\QuickBase\Client\Response;

interface HttpAdapterInterface
{
    /**
     * Send a request to quickbase
     *
     * @param Request $request
     * @return Response
     */
    public function send(Request $request);
} 