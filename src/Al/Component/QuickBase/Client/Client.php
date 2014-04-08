<?php

namespace Al\Component\QuickBase\Client;

use Al\Component\QuickBase\Builder\Factory\BuilderFactoryInterface;
use Al\Component\QuickBase\Client\HttpAdapter\HttpAdapterInterface;
use Al\Component\QuickBase\Exception\ClientConfigurationException;
use Al\Component\QuickBase\Exception\RequestException;
use GuzzleHttp\Message\ResponseInterface;

class Client
{
    /**
     * @var HttpAdapterInterface
     */
    private $httpAdapter;

    /**
     * @var BuilderFactoryInterface
     */
    private $builderFactory;

    /**
     * @var array
     */
    private $configuration;

    /**
     * @var string
     */
    private $ticket = null;

    public function __construct(
        array $configuration,
        HttpAdapterInterface $httpAdapter,
        BuilderFactoryInterface $builderFactory
    ) {
        $this->configuration = $configuration;
        $this->httpAdapter = $httpAdapter;
        $this->builderFactory = $builderFactory;
    }

    /**
     * @return HttpAdapterInterface
     */
    public function getHttpAdapter()
    {
        return $this->httpAdapter;
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
     * @return string
     */
    public function authenticate()
    {
        $this->ticket = $this->getTicketFromTheCache();

        if (null === $this->ticket) {
            $request = $this->builderFactory->get('authentication')
                ->setUsername($this->get('username'))
                ->setPassword($this->get('password'))
                ->setTicketValidity($this->get('ticket_life_time_in_hours'))
                ->setMessage($this->get('message'))
                ->getRequest();

            $this->ticket = $this->getHttpAdapter()
                ->send($request)
                ->getData('ticket', 'string');

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

        return $this->httpAdapter
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
     * @throws ClientConfigurationException
     */
    private function get($key)
    {
        if (isset($this->configuration[$key])) {
            return $this->configuration[$key];
        }

        throw new ClientConfigurationException($key);
    }
}
