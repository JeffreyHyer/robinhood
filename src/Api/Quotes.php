<?php

namespace Robinhood\Api;

class Quotes extends AbstractApi
{
    /**
     * Get near-real-time quotes for the given symbols
     *
     * @param  string|array $symbols The symbols to lookup (case insensitive)
     * @param  string       $cursor  The cursor to start at when retrieving paginated results
     *
     * @return object   [description]
     */
    public function quote($symbols, $cursor = "")
    {
        if (is_null($symbols)) {
            throw new \Exception("Robinhood\Api\Quotes::quote() => One or more symbols are required");
        }

        if (is_array($symbols)) {
            $symbols = implode(",", $symbols);
        }
        $symbols = strtoupper($symbols);

        return $this->get('quotes', ['symbols' => $symbols]);
    }

    /**
     * Get historical data (OHLC, Volume) for the specified symbols
     *
     * @param  string|array     $symbols  The symbols for which to retrieve the historical data
     * @param  string           $interval The data interval to obtain (5minute | 10minute | day)
     * @param  string           $span     The span of time to cover (week|day|year|5yr|all)
     * @param  string           $cursor   Find out if this is ever used...at day|year it is not used (~250 results returned)
     *
     * @return object           [description]
     *
     * @todo   Figure out the other interval/span combinations that are valid (there has to be one for 5yr and all)
     */
    public function historical($symbols, $interval = "10minute", $span = "day", $cursor = "")
    {
        if (is_null($symbols)) {
            throw new \Exception("Robinhood\Api\Quotes::quote() => One or more symbols are required");
        }

        if (is_array($symbols)) {
            $symbols = implode(",", $symbols);
        }
        $symbols = strtoupper($symbols);

        return $this->get('quotes/historicals', ['symbols' => $symbols, 'interval' => $interval, 'span' => $span]);
    }

    /**
     * Get the last price for a given symbol(s)
     *
     * @param  string|array $symbols The symbol(s) to retrieve prices for
     * @return object
     */
    public function price($symbols)
    {
        if (is_array($symbols)) {
            $symbols = implode(",", $symbols);
        }
        $symbols = strtoupper($symbols);

        return $this->get('prices/', ['symbols' => $symbols, 'delayed' => 'true', 'source' => 'consolidated']);
    }
}
