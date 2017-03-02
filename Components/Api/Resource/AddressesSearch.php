<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Exception as ApiException;
use Shopware\Components\Api\Resource\Address as AddressResource;

/**
 * Class AddressesSearch
 *
 * @package Shopware\Components\Api\Resource
 */
class AddressesSearch extends AddressResource
{
    public function getList($offset = 0, $limit = 25, array $criteria = array(), array $orderBy = array())
    {
        $this->checkPrivilege('read');

        $query = $this->getRepository()->getListQuery($criteria, $orderBy, $limit, $offset);
        $query->setHydrationMode(self::HYDRATE_ARRAY);

        $paginator = $this->getManager()->createPaginator($query);

        //returns the total count of the query
        $totalResult = $paginator->count();

        //returns the address data
        $addresses = $paginator->getIterator()->getArrayCopy();

        $addressesIds = [];
        foreach ($addresses as $key => $address){
            $addressesIds[$key] = $address['id'];
        }

        return array('data' => $addressesIds, 'total' => $totalResult);
    }
}
