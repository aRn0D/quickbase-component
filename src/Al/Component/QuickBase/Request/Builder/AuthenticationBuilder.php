<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Request\Builder;

use Al\Component\QuickBase\Request\Builder\Base\AbstractBuilder;

class AuthenticationBuilder extends AbstractBuilder
{
    public function setUsername($username)
    {
        $this->request->addParameter('username', $username);

        return $this;
    }

    public function setPassword($password)
    {
        $this->request->addParameter('password', $password);

        return $this;
    }

    public function setTicketValidity($ticketValidity)
    {
        $this->request->addParameter('hours', $ticketValidity);

        return $this;
    }

    public function setMessage($message)
    {
        $this->request->addParameter('udata', $message);

        return $this;
    }
}
