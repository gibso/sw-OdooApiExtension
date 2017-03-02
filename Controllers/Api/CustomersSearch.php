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

    /**
     * GET Request on /api/CustomersSearch
     */
    public function indexAction()
    {
        $limit = $this->Request()->getParam('limit', 1000);
        $offset = $this->Request()->getParam('start', 0);
        $sort = $this->Request()->getParam('sort', []);
        $filter = $this->Request()->getParam('filter', []);

        $result = $this->resource->getList($offset, $limit, $filter, $sort);

        $this->View()->assign(['success' => true, 'data' => $result]);
    }
}