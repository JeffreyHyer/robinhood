<?php

namespace Robinhood\Api;

class Banks extends AbstractApi
{
    /**
     * Get a list of bank/other? accounts linked to this Robinhood account (via ACH)
     *
     * @return object
     */
    public function accounts()
    {
        return $this->get('ach/relationships');
    }

    /**
     * Get details on a specific account specified by its ID
     *
     * @param  string $id The ID of the bank account to retrieve
     *
     * @return object
     */
    public function account($id)
    {
        return $this->get("ach/relationships/{$id}");
    }

    /**
     * Unlink a given bank account from this Robinhood account
     *
     * @param  string $id The ID of the bank account to unlink
     *
     * @return object
     */
    public function unlinkAccount($id)
    {
        return $this->get("ach/relationships/{$id}/unlink");
    }

    /**
     * Get a list of all scheduled deposits for this Robinhood account
     *
     * @param  $cursor The cursor to start at for paginated results
     *
     * @return object
     */
    public function scheduledDeposits($cursor = "")
    {
        return $this->get('ach/deposit_schedules', ['cursor' => $cursor]);
    }

    /**
     * Get a specific scheduled deposity identified by its ID
     *
     * @param  string $id The ID of the scheduled deposit
     *
     * @return object
     */
    public function scheduledDeposit($id)
    {
        return $this->get("ach/deposit_schedules/{$id}");
    }

    /**
     * Get a list of all transfers for this account
     *
     * @param  string $cursor The cursor to start at for paginated results
     *
     * @return object
     */
    public function transfers($cursor = "")
    {
        return $this->get("ach/transfers", ['cursor' => $cursor]);
    }

    /**
     * Get a single transfer
     *
     * @param  string $id The ID of the transfer to get
     *
     * @return object
     */
    public function transfer($id)
    {
        return $this->get("ach/transfers/{$id}");
    }

    /**
     * Get a list of wire relationships
     *
     * @param  string $cursor The cursor to start at for paginated results
     *
     * @return object
     */
    public function wires($cursor = "")
    {
        return $this->get("wire/relationships", ['cursor' => $cursor]);
    }

    /**
     * Get a single wire relationship
     *
     * @param  string $id The ID of the wire relationship
     *
     * @return object
     */
    public function wire($id)
    {
        return $this->get("wire/relationships/{$id}");
    }

    /**
     * Get a list of wire transfers to/from this account
     *
     * @param  string $cursor The cursor to start at for paginated results
     *
     * @return object
     */
    public function wireTransfers($cursor = "")
    {
        return $this->get("wire/transfers", ['cursor' => $cursor]);
    }

    /**
     * Get a single wire transfer
     *
     * @param  string $id The ID of the wire transfer to get
     *
     * @return object
     */
    public function wireTransfer($id)
    {
        return $this->get("wire/transfers/{$id}");
    }
}
