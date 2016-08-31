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
     * @param  string $instrumentId The instrument ID to retrieve (or instrument URL from which the ID will be extracted)
     *
     * @return description
     */
    public function instrument($instrumentId)
    {
        if (strpos($instrumentId, 'api.robinhood.com') !== false) {
            if (preg_match('/[\da-f]{8}-[\da-f]{4}-[\da-f]{4}-[\da-f]{4}-[\da-f]{12}/i', $instrumentId, $matches) === 1) {
                $instrumentId = $matches[0];
            }
        }

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

    /**
     * Get the latest price for a given instrument(s)
     *
     * @param  string|array $instruments Instrument id(s) to retrieve. Takes the full ID URL or just the ID. ID's will be converted to URLs.
     *
     * @return object
     */
    public function price($instruments)
    {
        if (is_array($instruments)) {
            foreach ($instruments as &$instrument) {
                if (preg_match('/^[\da-f]{8}-([\da-f]{4}-){3}[\da-f]{12}$/i', $instrument) === 1) {
                    $instrument = "https://api.robinhood.com/instruments/{$instrument}/";
                }
            }

            $instruments = implode(",", $instruments);
        }
        $instruments = strtolower($instruments);

        return $this->get('prices/', ['instruments' => $instruments, 'delayed' => 'true', 'source' => 'consolidated']);
    }
}
