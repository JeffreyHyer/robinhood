<?php

namespace Robinhood\Api;

class Watchlists extends AbstractApi
{

    public function watchlists($cursor = "")
    {
        return $this->get('watchlists', ['cursor' => $cursor]);
    }

    public function watchlist($name, $cursor = "")
    {
        return $this->get("watchlists/{$name}", ['cursor' => $cursor]);
    }
}
