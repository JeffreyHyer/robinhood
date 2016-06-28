<?php

namespace Robinhood\Api;

class Authentication extends AbstractApi
{
    public function login($skipAccountId = false)
    {
        $response = $this->post(
            'api-token-auth',
            [
                'username' => $this->robinhood->username,
                'password' => $this->robinhood->password
            ],
            [],
            false
        );

        if ($response->code == 200) {
            $this->robinhood->token = $response->response->token;

            if (($this->robinhood->account == "") && (!$skipAccountId)) {
                $account = new Account($this->robinhood);
                $acc = $account->accounts();

                if ($acc->code == 200) {
                    // We assume the first account in the list is the correct one
                    // if not, you'll have to define it in the Robinhood() constructor
                    $this->robinhood->account = $acc->response->results[0]->account_number;

                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            throw new \Exception($response->reason . ": " . $response->response->detail);
        }
    }

    public function logout()
    {
        // TODO: Implement
    }

    public function requestPasswordReset($email)
    {
        // TODO: Implement
    }

    public function resetPassword($resetToken)
    {
        // TODO: Implement
    }
}
