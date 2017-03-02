<?php

/**
 * Class Customers
 */
class Shopware_Controllers_Api_CustomersExtended extends Shopware_Controllers_Api_Customers
{

    /**
     * @var Shopware\Components\Api\Resource\CustomersExtended
     */
    protected $resource;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('CustomersExtended');
    }
}