<?php

/**
 * Class Shopware_Controllers_Api_CustomerGroupsSearch
 */
class Shopware_Controllers_Api_CustomerGroupsSearch extends Shopware_Controllers_Api_CustomerGroups
{
    /**
     * @var Shopware\Components\Api\Resource\CustomerGroupsSearch
     */
    protected $resource;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('CustomerGroupsSearch');
    }

    /**
     * GET Request on /api/CustomerGroupsSearch
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