<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Resource\Shop as ShopResource;

/**
 * Class ShopsSearch
 *
 * @package Shopware\Components\Api\Resource
 */
class ShopsSearch extends ShopResource
{
  public function getList($offset = 0, $limit = 25, array $criteria = array(), array $orderBy = array())
  {
      $this->checkPrivilege('read');

      $builder = $this->getRepository()->createQueryBuilder('shop');

      $builder->addFilter($criteria)
          ->addOrderBy($orderBy)
          ->setFirstResult($offset)
          ->setMaxResults($limit);

      $builder->select('shop.id');

      $query = $builder->getQuery();
      $query->setHydrationMode($this->resultMode);

      $paginator = $this->getManager()->createPaginator($query);

      //returns the total count of the query
      $totalResult = $paginator->count();

      //returns the category data
      $shops = $paginator->getIterator()->getArrayCopy();

      $shopIds = [];
      foreach ($shops as $key => $shop){
          $shopIds[$key] = $shop['id'];
      }

      return array('data' => $shopIds, 'total' => $totalResult);
  }
}
