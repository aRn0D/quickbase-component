<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Request\Builder\Base;

use Al\Component\QuickBase\Request\Request;

interface BuilderInterface
{
    const QUERY = 'API_DoQuery';
    const ADD_RECORD = 'API_AddRecord';
    const EDIT_RECORD = 'API_EditRecord';
    const DELETE_RECORD = 'API_DeleteRecord';

    /**
     * Create an instace of a Request
     *
     * @param  string $action
     * @return $this
     */
    public function createRequest($action);

    /**
     * Return the request
     *
     * @return Request
     */
    public function getRequest();
}
