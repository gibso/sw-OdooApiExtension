<?php

/**
 * Class Shopware_Controllers_Api_ShopsSearch
 */
class Shopware_Controllers_Api_ShopsSearch extends Shopware_Controllers_Api_Shops
{
    /**
     * @var Shopware\Components\Api\Resource\ShopsSearch
     */
    protected $resource;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('ShopsSearch');
    }
}
