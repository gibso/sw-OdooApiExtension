<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Resource\Order as OrderResource;

/**
 * Class OrdersSearch
 *
 * @package Shopware\Components\Api\Resource
 */
class OrdersSearch extends OrderResource
{
    public function getList($offset = 0, $limit = 25, array $criteria = [], array $orderBy = [])
    {
        $this->checkPrivilege('read');

        $builder = $this->getRepository()->createQueryBuilder('orders')
            ->addSelect(['attribute'])
            ->leftJoin('orders.attribute', 'attribute');

        $builder->addFilter($criteria);
        $builder->addOrderBy($orderBy);
        $builder->setFirstResult($offset)
            ->setMaxResults($limit);
        $builder->addSelect(['partial customer.{id,email}']);
        $builder->leftJoin('orders.customer', 'customer');
        $query = $builder->getQuery();

        $query->setHydrationMode($this->getResultMode());

        $paginator = $this->getManager()->createPaginator($query);

        //returns the total count of the query
        $totalResult = $paginator->count();

        //returns the order data
        $orders = $paginator->getIterator()->getArrayCopy();

        foreach ($orders as &$order) {
            if (is_array($order)) {
                $order['paymentStatusId'] = $order['cleared'];
                $order['orderStatusId'] = $order['status'];
                unset($order['cleared']);
                unset($order['status']);
            }
        }

        return ['data' => $orders, 'total' => $totalResult];
    }

}