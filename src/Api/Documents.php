<?php

namespace Robinhood\Api;

class Documents extends AbstractApi
{
    /**
     * Get a list of documents associated with the authenticating user
     *
     * @return object
     */
    public function documents()
    {
        return $this->get("documents");
    }

    /**
     * Get a specific document identified by it's ID
     *
     * @param  string $id The ID of the document to retrieve
     *
     * @return object
     */
    public function document($id)
    {
        return $this->get("documents/{$id}/");
    }

    /**
     * Initiates a file download from the Robinhood server.
     * TODO: Implement method
     *
     * @param  string $id The ID of the document to download
     *
     * @return object
     */
    public function download($id)
    {
        // return $this->get("documents/{$id}/download/");
    }
}
