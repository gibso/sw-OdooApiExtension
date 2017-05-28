<?php

/**
 * Class Shopware_Controllers_Api_OrdersSearch
 */
class Shopware_Controllers_Api_OrdersSearch extends Shopware_Controllers_Api_Orders
{
    /**
     * @var Shopware\Components\Api\Resource\OrdersSearch
     */
    protected $resource;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('OrdersSearch');
    }
}