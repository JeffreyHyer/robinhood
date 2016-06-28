<?php

namespace Robinhood\Api;

class User extends AbstractApi
{
    /**
     * Get details on the current user
     *
     * @return object
     */
    public function user()
    {
        return $this->get("user");
    }

    /**
     * Get the current user's ID
     *
     * @return object
     */
    public function userId()
    {
        return $this->get("user/id");
    }

    /**
     * Get the user's basic info
     *
     * @return object
     */
    public function basicInfo()
    {
        return $this->get("user/basic_info");
    }

    /**
     * Get the user's investment profile
     *
     * @return object
     */
    public function investmentProfile()
    {
        return $this->get("user/investment_profile");
    }

    /**
     * Get the user's international information (not available for U.S. customers?)
     *
     * @return object
     */
    public function internationalInfo()
    {
        return $this->get("user/international_info");
    }

    /**
     * Get the user's employment information
     *
     * @return object
     */
    public function employment()
    {
        return $this->get("user/employment");
    }

    /**
     * Get additional information about the user
     *
     * @return object
     */
    public function additionalInfo()
    {
        return $this->get("user/additional_info");
    }
}
