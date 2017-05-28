<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Resource\Category as CategoryResource;

/**
 * Class CategoriesSearch
 *
 * @package Shopware\Components\Api\Resource
 */
class CategoriesSearch extends CategoryResource
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
        foreach ($categories as $key => $category){
            $categoriesIds[$key] = $category['id'];
        }

        return array('data' => $categoriesIds, 'total' => $totalResult);
    }
}
