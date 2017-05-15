<?php

/**
 * Class Shopware_Controllers_Api_AddressesSearch
 */
class Shopware_Controllers_Api_AddressesSearch extends Shopware_Controllers_Api_Addresses
{
    /**
     * @var Shopware\Components\Api\Resource\AddressesSearch
     */
    protected $resource;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('AddressesSearch');
    }
}