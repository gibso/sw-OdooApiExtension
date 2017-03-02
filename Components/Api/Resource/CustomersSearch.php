<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Exception as ApiException;
use Shopware\Components\Api\Resource\Customer as CustomerResource;
use Shopware\Models\Customer\Customer as CustomerGroup;
use Shopware\Models\Customer\Customer;

/**
 * Class CustomersSearch
 *
 * @package Shopware\Components\Api\Resource
 */
class CustomersSearch extends CustomerResource
{
    public function getList($offset = 0, $limit = 25, array $criteria = array(), array $orderBy = array())
    {
        $this->checkPrivilege('read');

        /**
         * @var Customer[] $allCustomers
         */
        $allCustomers = $this->getRepository()->findAll();

        $allCustomersIds = [];

        foreach($allCustomers as $customer){
            $allCustomersIds[] = $customer->getId();
        }

        return $allCustomersIds;
    }
}
