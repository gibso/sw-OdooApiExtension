<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Exception as ApiException;
use Shopware\Components\Api\Resource\CustomerGroup as CustomerGroupResource;
use Shopware\Models\Customer\Group as CustomerGroup;

/**
 * Class CustomerGroupsSearch
 *
 * @package Shopware\Components\Api\Resource
 */
class CustomerGroupsSearch extends CustomerGroupResource
{
    public function getList($offset = 0, $limit = 25, array $criteria = array(), array $orderBy = array())
    {
        $this->checkPrivilege('read');

        $allCustomerGroups = $this->getRepository()->findAll();

        $allCustomerGroupsIds = [];

        /**
         * @var CustomerGroup $customerGroup
         */
        foreach($allCustomerGroups as $customerGroup){
            $allCustomerGroupsIds[] = $customerGroup->getId();
        }

        return $allCustomerGroupsIds;
    }
}
