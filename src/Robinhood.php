<?php

namespace Robinhood;

use GuzzleHttp\Client;

class Robinhood
{
    /**
     * The Guzzle instance used for all requests to the Robinhood API
     *
     * @var \GuzzleHttp\Client
     */
    public $client;

    /**
     * Robinhood Username
     *
     * @var string
     */
    public $username;

    /**
     * Robinhood Password
     *
     * @var string
     */
    public $password;

    /**
     * Robinhood Account ID
     *
     * @var string
     */
    public $account;

    /**
     * Access token for authenticated requests
     *
     * @var string
     */
    public $token;

    /**
     * The default configuration options
     *
     * @var array
     */
    public $options = [
        'base_uri' => 'https://api.robinhood.com/',
        'api_version' => '1.90.3'
    ];

    /**
     * Robinhood constructor
     *
     * @param string    $username  Robinhood username
     * @param string    $password  Robinhood password
     * @param string    $token     Robinhood API token (if already authenticated)
     * @param string    $account   Robinhood account ID
     * @param array     $options   Array of options to be used in requests to the API
     */
    public function __construct($username = "", $password = "", $account = "", $token = "", $options = [])
    {
        $this->username = $username;
        $this->password = $password;
        $this->token    = $token;
        $this->account  = $account;

        $this->options = array_merge($options, $this->options);

        $this->client = new Client();
    }

    /**
     * [_buildUrl description]
     *
     * @param  string $path         [description]
     * @param  array  $queryStrings [description]
     * @param  string $domain       [description]
     *
     * @return string               [description]
     */
    public function _buildUrl($path = "", $queryStrings = [], $domain = "")
    {
        $queryString = "";
        foreach ($queryStrings as $key => $value) {
            if (is_array($value)) {
                continue;
            }

            $queryString .= "&{$key}={$value}";
        }
        if (strlen($queryString) > 0) {
            $queryString = "?" . substr($queryString, 1);
        }

        if ($domain == "") {
            $domain = $this->options['base_uri'];
        }

        $path = "/" . trim($path, "/") . "/";

        return "{$domain}{$path}{$queryString}";
    }

    public function _getHeaders()
    {
        // Return an array of HTTP headers used to make a request to the Robinhood API
    }

    public function _getAuthToken()
    {
        if ($this->token == "") {
            $auth = new Api\Authentication($this);
            $auth->login();
        }

        return $this->token;
    }

    protected function api($name)
    {
        switch ($name) {
            case 'auth':
            case 'authentication':
                return new Api\Authentication($this);

            case 'quote':
            case 'quotes':
                return new Api\Quotes($this);

            case 'account':
            case 'accounts':
                return new Api\Account($this);

            case 'user':
            case 'users':
                return new Api\User($this);

            case 'instrument':
            case 'instruments':
                return new Api\Instruments($this);

            case 'ach':
            case 'wire':
            case 'wires':
            case 'bank':
            case 'banks':
                return new Api\Banks($this);

            case 'order':
            case 'orders':
                return new Api\Orders($this);

            case 'watchlist':
            case 'watchlists':
                return new Api\Watchlists($this);

            case 'market':
            case 'markets':
            case 'exchange':
            case 'exchanges':
                return new Api\Markets($this);

            default:
                throw new \Exception("Invalid API ($name)");
        }
    }

    /**
     * [__call description]
     *
     * @param  [type] $method [description]
     * @param  [type] $args   [description]
     *
     * @return [type]         [description]
     */
    public function __call($method, $args)
    {
        return $this->api($method);
    }
}
