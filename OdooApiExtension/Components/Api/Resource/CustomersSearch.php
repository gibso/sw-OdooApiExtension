<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Resource\Customer as CustomerResource;

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

        $builder = $this->getRepository()->createQueryBuilder('customer');

        $builder->addFilter($criteria);
        $builder->addOrderBy($orderBy);
        $builder->setFirstResult($offset)
            ->setMaxResults($limit);

        $builder->select('customer.id');

        $query = $builder->getQuery();

        $query->setHydrationMode($this->getResultMode());

        $paginator = $this->getManager()->createPaginator($query);

        //returns the total count of the query
        $totalResult = $paginator->count();

        //returns the customer data
        $customers = $paginator->getIterator()->getArrayCopy();

        $customerIds = [];
        foreach ($customers as $key => $customer){
            $customerIds[$key] = $customer['id'];
        }

        return ['data' => $customerIds, 'total' => $totalResult];
    }
}
