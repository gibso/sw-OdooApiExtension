<?php

/**
 * Class Shopware_Controllers_Api_ArticlesSearch
 */
class Shopware_Controllers_Api_ArticlesSearch extends Shopware_Controllers_Api_Articles
{
    /**
     * @var Shopware\Components\Api\Resource\ArticlesSearch
     */
    protected $resource;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('ArticlesSearch');
    }
}