<?php

namespace Robinhood\Api;

class Instruments extends AbstractApi
{
    /**
     * Get all the available instruments (paginated)
     *
     * @param  string $cursor The cursor to start at for paginated results
     *
     * @return object
     */
    public function instruments($cursor = "")
    {
        return $this->get("instruments", ['cursor' => $cursor]);
    }

    /**
     * Get an instrument by its symbol
     *
     * @param  string $symbol The symbol for which to retrieve the instrument data
     *
     * @return object
     */
    public function instrumentsBySymbol($symbol)
    {
        $symbol = strtoupper($symbol);

        return $this->get("instruments", ['symbol' => $symbol]);
    }

    /**
     * Get the instrument as specified by the instrument ID
     *
     * @param  string $instrumentId The instrument ID to retrieve
     *
     * @return description
     */
    public function instrument($instrumentId)
    {
        return $this->get("instruments/{$instrumentId}");
    }

    /**
     * Get an instruments split information
     *
     * @param  string $instrumentId The instrument ID for which to retrieve split information
     *
     * @return string
     */
    public function splits($instrumentId)
    {
        return $this->get("instruments/{$instrumentId}/splits");
    }

    /**
     * Get information on a single split event
     *
     * @param  string $instrumentId     The instrument ID
     * @param  string $splitId          The split ID
     *
     * @return object
     */
    public function split($instrumentId, $splitId)
    {
        return $this->get("instruments/{$instrumentId}/splits/{$splitId}");
    }

    /**
     * Get fundamentals for a given symbol(s)
     *
     * @param  string|array $symbols The symbol(s) for which to retrieve fundamental data
     *
     * @return object
     */
    public function fundamentalsBySymbol($symbols)
    {
        if (is_array($symbols)) {
            $symbols = implode(",", $symbols);
        }
        $symbols = strtoupper($symbols);

        return $this->get("fundamentals", ['symbols' => $symbols]);
    }

    /**
     * Get fundamentals for a given instrument
     *
     * @param  string $instrumentId The instrument ID for which to retrieve the fundamental data
     *
     * @return object
     */
    public function fundamentals($instrumentId)
    {
        return $this->get("fundamentals/{$instrumentId}");
    }
}
