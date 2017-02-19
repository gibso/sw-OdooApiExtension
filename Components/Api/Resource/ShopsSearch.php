<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Exception as ApiException;
use Shopware\Components\Api\Resource\Shop as ShopResource;
use Shopware\Models\Shop\Shop;

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

      $allShops = $this->getRepository()->findAll();

      $allShopsIds = [];

      /**
       * @var Shop $shop
       */
      foreach($allShops as $shop){
          $allShopsIds[] = $shop->getId();
      }

      return $allShopsIds;
  }
}
