<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Exception as ApiException;
use Shopware\Components\Api\Resource\Category as AddressResource;

/**
 * Class CategoriesSearch
 *
 * @package Shopware\Components\Api\Resource
 */
class CategoriesSearch extends AddressResource
{
    /**
     * @param int $offset
     * @param int $limit
     * @param array $criteria
     * @param array $orderBy
     * @return array
     */
    public function getList($offset = 0, $limit = 25, array $criteria = array(), array $orderBy = array())
    {
        $this->checkPrivilege('read');

        $query = $this->getRepository()->getListQuery($criteria, $orderBy, $limit, $offset);
        $query->setHydrationMode($this->resultMode);

        $paginator = $this->getManager()->createPaginator($query);

        //returns the total count of the query
        $totalResult = $paginator->count();

        //returns the category data
        $categories = $paginator->getIterator()->getArrayCopy();

        $categoriesIds = [];
        foreach ($categories as $key => $address){
            $categoriesIds[$key] = $address['id'];
        }

        return array('data' => $categoriesIds, 'total' => $totalResult);
    }
}
