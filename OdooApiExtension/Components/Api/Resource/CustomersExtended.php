<?php

namespace Shopware\Components\Api\Resource;

use Doctrine\ORM\Query\Expr\Join;
use Shopware\Components\Api\Resource\Customer as CustomerResource;
use Shopware\Components\Api\Exception as ApiException;


/**
 * Class CustomersExtended
 *
 * @package Shopware\Components\Api\Resource
 */
class CustomersExtended extends CustomerResource
{

    public function getOne($id)
    {
        $this->checkPrivilege('read');

        if (empty($id)) {
            throw new ApiException\ParameterMissingException();
        }

        $builder = $this->getRepository()->createQueryBuilder('customer');

        $builder->select([
            'customer',
            'attribute',
            'billing',
            'billingAttribute',
            'shipping',
            'shippingAttribute',
            'paymentData',
            'billingCountry',
            'shippingCountry',
            'billingState',
            'shippingState',
            'groups'
        ]);
        $builder->leftJoin('customer.attribute', 'attribute')
            ->leftJoin('customer.defaultBillingAddress', 'billing')
            ->leftJoin('customer.paymentData', 'paymentData', Join::WITH, 'paymentData.paymentMean = customer.paymentId')
            ->leftJoin('billing.attribute', 'billingAttribute')
            ->leftJoin('customer.defaultShippingAddress', 'shipping')
            ->leftJoin('shipping.attribute', 'shippingAttribute')
            ->leftJoin('billing.country', 'billingCountry')
            ->leftJoin('shipping.country', 'shippingCountry')
            ->leftJoin('billing.state', 'billingState')
            ->leftJoin('shipping.state', 'shippingState')
            ->leftJoin('customer.group', 'groups', Join::WITH, 'customer.groupKey = groups.key')
            ->where('customer.id = ?1')
            ->setParameter(1, $id);


        /** @var $customer \Shopware\Models\Customer\Customer */
        $customer = $builder->getQuery()->getOneOrNullResult($this->getResultMode());

        if (!$customer) {
            throw new ApiException\NotFoundException("Customer by id $id not found");
        }

        return $customer;
    }
}