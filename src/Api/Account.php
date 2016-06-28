<?php

namespace Robinhood\Api;

class Account extends AbstractApi
{
    /**
     * Get the list of accounts available
     *
     * @return object   [description]
     */
    public function accounts()
    {
        return $this->get('accounts');
    }

    /**
     * Get a specific account identified by $account
     *
     * @param  string $account The account number to retrieve (defaults to the logged in users' first account)
     *
     * @return object          [description]
     */
    public function account($account = "")
    {
        if ($account == "") {
            $account = $this->robinhood->account;
        }

        return $this->get("accounts/{$account}");
    }

    /**
     * Get the portfolio for the given $account
     *
     * @param  string $account The account number to retrieve (defaults to the logged in users' first account)
     *
     * @return object          [description]
     */
    public function portfolio($account = "")
    {
        if ($account == "") {
            $account = $this->robinhood->account;
        }

        return $this->get("accounts/{$account}/portfolio");
    }

    /**
     * Get an accounts positions
     *
     * @param  string $account The account number to retrieve (defaults to the logged in users' first account)
     * @param  string $cursor  The cursor to start at for paginated results
     *
     * @return object          [description]
     */
    public function positions($account = "", $position = "", $cursor = "")
    {
        if ($account == "") {
            $account = $this->robinhood->account;
        }

        return $this->get("accounts/{$account}/positions");
    }
}
