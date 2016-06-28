<?php

namespace Robinhood\Api;

use GuzzleHttp\Client;

abstract class AbstractApi
{
    /**
     * [$client description]
     *
     * @var GuzzleHttp\Client
     */
    protected $robinhood;

    /**
     * [__construct description]
     *
     * @param \Robinhood\Robinhood $robinhood [description]
     */
    public function __construct(\Robinhood\Robinhood $robinhood)
    {
        $this->robinhood = $robinhood;
    }

    /**
     * [get description]
     *
     * @param  [type] $path     [description]
     * @param  [type] $queryStr [description]
     *
     * @return [type]           [description]
     */
    public function get($path, $queryStr = [], $auth = true)
    {
        try {
            $response = $this->robinhood->client->request(
                'GET',
                $this->robinhood->_buildUrl($path, $queryStr),
                [
                    'headers' => [
                        'Authorization' => (($auth) ? 'Token ' . $this->robinhood->_getAuthToken() : null),
                        'Content-Type'  => 'application/x-www-form-urlencoded',
                        'Accept'        => 'application/json',
                    ]
                ]
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * [post description]
     *
     * @param  string  $path     [description]
     * @param  array   $body     [description]
     * @param  array   $queryStr [description]
     * @param  boolean $auth     [description]
     *
     * @return object            [description]
     */
    public function post($path, $body, $queryStr = [], $auth = true)
    {
        try {
            $response = $this->robinhood->client->request(
                'POST',
                $this->robinhood->_buildUrl($path, $queryStr),
                [
                    'headers' => [
                        'Authorization' => (($auth) ? 'Token ' . $this->robinhood->_getAuthToken() : null),
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/x-www-form-urlencoded',
                    ],
                    'body' => ((is_array($body)) ? http_build_query($body) : $body)
                ]
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * [_respond description]
     *
     * @param  Psr\Http\Message\ResponseInterface $response [description]
     *
     * @return [type]                                       [description]
     */
    protected function _respond(\Psr\Http\Message\ResponseInterface $response)
    {
        $retval = (object)[
            'code'      => $response->getStatusCode(),
            'reason'    => $response->getReasonPhrase(),
            'response'  => json_decode($response->getBody()->getContents())
        ];

        return $retval;
    }
}
