<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Component\QuickBase\Request;

class Request
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $token;

    /**
     * @var array
     */
    private $parameters = array();

    public function __construct($action)
    {
        $this->action = $action;
    }

    /**
     * @param string $host
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param  string $key
     * @return mixed
     */
    public function getParameter($key)
    {
        return $this->parameters[$key];
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function addParameter($name, $value)
    {
        $this->parameters[$name] = $value;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function appendToParameter($name, $value)
    {
        $this->parameters[$name][] = $value;

        return $this;
    }

    /**
     * @param string $name
     * @param array$attributes
     * @param mixed $value
     * @return $this
     */
    public function addCollectionParameter($name, $value, array $attributes = array())
    {
        $this->parameters[$name][] = array(
            'attributes' => $attributes,
            'values' => $value
        );

        return $this;
    }


    /**
     * @param $key
     * @return bool
     */
    public function hasParameter($key)
    {
        return isset($this->parameters[$key]);
    }

    /**
     * @param  null  $key
     * @return $this
     */
    public function clearParameter($key = null)
    {
        if ($this->hasParameter($key)) {
            unset($this->parameters[$key]);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function clearParameters()
    {
        $this->parameters = array();

        return $this;
    }

    public function getBody()
    {
        return '';
    }
}
