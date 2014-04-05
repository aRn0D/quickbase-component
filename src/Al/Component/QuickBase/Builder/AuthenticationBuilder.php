<?php

namespace Al\Component\QuickBase\Builder;

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
