<?php

namespace Robinhood\Api;

class Orders extends AbstractApi
{

    /**
     * Get a list of orders for this account
     *
     * @param  string $timestamp Only get orders GTE this date/time
     * @param  string $cursor    The cursor to start at for paginated results
     *
     * @return object
     */
    public function orders($timestamp = "", $cursor = "")
    {
        $params = [];

        if ($timestamp != "") {
            $params['updated_at[gte]'] = date("Y-m-d\TH:i:s\Z", strtotime($timestamp));
        }

        $params['cursor'] = $cursor;

        return $this->get('orders', $params);
    }

    /**
     * Get a single order by ID
     *
     * @param  string $orderId The ID of the order to get
     *
     * @return object
     */
    public function order($orderId)
    {
        return $this->get("orders/{$orderId}");
    }
}
