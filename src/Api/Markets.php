<?php

namespace Robinhood\Api;

class Markets extends AbstractApi
{
    /**
     * Get a list of valid markets/exchanges supported by Robinhood
     *
     * @return object
     */
    public function markets()
    {
        return $this->get("markets");
    }

    /**
     * Get details on a specific market/exchange identified by it's MIC
     *
     * @param  string $mic The MIC of the specific market/exchange
     *
     * @return object
     */
    public function market($mic)
    {
        $mic = strtoupper($mic);

        return $this->get("markets/{$mic}/");
    }

    /**
     * Get a specific market/exchange's hours (normal, extended, closed)
     *
     * @param  string $mic  The MIC of the specific market/exchange
     * @param  string $date The date for which to retrieve the hours, defaults to the current date
     *
     * @return object
     */
    public function hours($mic, $date = "")
    {
        $mic = strtoupper($mic);

        if ($date == "") {
            $date = date('Y-m-d');
        } else {
            $date = date('Y-m-d', strtotime($date));
        }

        return $this->get("markets/{$mic}/hours/{$date}/");
    }
}
