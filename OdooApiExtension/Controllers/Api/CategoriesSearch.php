<?php

/**
 * Class Shopware_Controllers_Api_CategoriesSearch
 */
class Shopware_Controllers_Api_CategoriesSearch extends Shopware_Controllers_Api_Categories
{
    /**
     * @var Shopware\Components\Api\Resource\CategoriesSearch
     */
    protected $resource;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('CategoriesSearch');
    }
}