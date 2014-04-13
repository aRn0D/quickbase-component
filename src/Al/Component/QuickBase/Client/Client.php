<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Client;

use Al\Component\QuickBase\Request\Builder\AuthenticationBuilder;
use Al\Component\QuickBase\Client\TransportAdapter\TransportAdapterInterface;
use Al\Component\QuickBase\Exception\ConfigurationException;
use Al\Component\QuickBase\Request\Request;

class Client
{
    /**
     * @var TransportAdapterInterface
     */
    private $transportAdapter;

    /**
     * @var array
     */
    private $configuration;

    /**
     * @var string
     */
    private $ticket = null;

    /**
     * @var string
     */
    private $userId = null;

    public function __construct(
        array $configuration,
        TransportAdapterInterface $httpAdapter
    ) {
        $this->configuration = $configuration;
        $this->transportAdapter = $httpAdapter;
    }

    /**
     * @return TransportAdapterInterface
     */
    public function getTransportAdapter()
    {
        return $this->transportAdapter;
    }

    /**
     * @return string
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Return the ticket
     *
     * @return $this
     */
    public function authenticate()
    {
        $this->ticket = $this->getTicketFromTheCache();

        if (null === $this->ticket) {
            $request = (new Request('API_Authenticate'))
                ->addParameter('username', $this->get('username'))
                ->addParameter('password', $this->get('password'))
                ->addParameter('hours', $this->get('ticket_life_time_in_hours'))
                ->addParameter('udata', $this->get('message'));

            $response = $this->getTransportAdapter()->send($request);

            $this->ticket = $response->getData('ticket', 'string');
            $this->userId = $response->getData('userid', 'string');

            $this->saveTicket();
        }

        return $this;
    }

    /**
     * Send a request to quickbase
     *
     * @param Request $request
     * @return mixed
     */
    public function send(Request $request)
    {
        $request->setHost($this->get('host'))
            ->setToken($this->get('token'));

        return $this->transportAdapter
            ->send($request);
    }

    /**
     * Return the ticket from the cache
     *
     * @return null
     */
    private function getTicketFromTheCache()
    {
        $ticketFilePath = $this->get('cached_ticket');

        if (file_exists($ticketFilePath)) {
            list($ticket, $expiry) = explode(';', file_get_contents($ticketFilePath));

            if ($ticket && $expiry > time()) {
                return $ticket;
            }
        }

        return null;
    }

    /**
     * Save the ticket in the cache
     */
    private function saveTicket()
    {
        $expiry = new \DateTime('now');

        file_put_contents(
            $this->get('cached_ticket'),
            implode(';', array($this->ticket, $expiry->format('U')))
        );
    }

    /**
     * Get parameter from the configuration
     *
     * @param  string                       $key
     * @return string
     * @throws ConfigurationException
     */
    private function get($key)
    {
        if (isset($this->configuration[$key])) {
            return $this->configuration[$key];
        }

        throw new ConfigurationException($key);
    }
}
