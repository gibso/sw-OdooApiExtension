<?php

/**
 * Class Shopware_Controllers_Api_CustomersSearch
 */
class Shopware_Controllers_Api_CustomersSearch extends Shopware_Controllers_Api_Customers
{
    /**
     * @var Shopware\Components\Api\Resource\CustomersSearch
     */
    protected $resource;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('CustomersSearch');
    }
}