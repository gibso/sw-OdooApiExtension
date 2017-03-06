<?php

/**
 * Class Shopware_Controllers_Api_VariantsSearch
 */
class Shopware_Controllers_Api_VariantsSearch extends Shopware_Controllers_Api_Variants
{
    /**
     * @var Shopware\Components\Api\Resource\VariantsSearch
     */
    protected $resource;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('VariantsSearch');
    }
}