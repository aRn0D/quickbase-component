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

class Response
{
    /**
     * @var \SimpleXMLElement
     */
    private $response;

    public function __construct($xml)
    {
        $this->response = new \SimpleXMLElement($xml);
    }

    /**
     * Check if a errors occurs
     *
     * @return bool
     */
    public function isErrored()
    {
        return (integer) $this->getdata('errcode') != 0;
    }

    /**
     * Get the executed action
     *
     * @return string
     */
    public function getAction()
    {
        return (string) $this->getdata('action');
    }

    /**
     * Get the error code and error message as an array
     *
     * @return array
     */
    public function getError()
    {
        $error = array();
        if ($this->isErrored()) {
            return array(
                'code' => (integer) $this->getdata('errcode'),
                'message' => (string) $this->getdata('errtext')
            );
        }

        return $error;
    }

    /**
     * Get date in the SimpleXMLElement object
     *
     * @param string $key
     * @param null|string $type
     * @return mixed
     */
    public function getData($key, $type = null)
    {
        $data = $this->response->$key;

        if (null !== $type) {
            settype($data, $type);
        }

        return $data;
    }
}
