<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Resource\CustomerGroup as CustomerGroupResource;

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

        $builder = $this->getRepository()->createQueryBuilder('customerGroup')
            ->select('customerGroup', 'd')
            ->leftJoin('customerGroup.discounts', 'd');

        $builder->addFilter($criteria)
            ->addOrderBy($orderBy)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $builder->select('customerGroup.id');

        $query = $builder->getQuery();
        $query->setHydrationMode($this->resultMode);

        $paginator = $this->getManager()->createPaginator($query);

        //returns the total count of the query
        $totalResult = $paginator->count();

        //returns the category data
        $customerGroups = $paginator->getIterator()->getArrayCopy();

        $customerGroupIds = [];
        foreach ($customerGroups as $key => $customerGroup){
            $customerGroupIds[$key] = $customerGroup['id'];
        }

        return array('data' => $customerGroupIds, 'total' => $totalResult);
    }
}
