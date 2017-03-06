<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Exception as ApiException;
use Shopware\Components\Api\Resource\Variant as VariantResource;

/**
 * Class VariantsSearch
 *
 * @package Shopware\Components\Api\Resource
 */
class VariantsSearch extends VariantResource
{

    /**
     * @param int $offset
     * @param int $limit
     * @param array $criteria
     * @param array $orderBy
     * @param array $options
     * @return array
     */
    public function getList($offset = 0, $limit = 25, array $criteria = [], array $orderBy = [], array $options = [])
    {
        $this->checkPrivilege('read');

        /** @var \Doctrine\DBAL\Query\QueryBuilder */
        $builder = $this->getRepository()->createQueryBuilder('detail');

        $builder
            ->addFilter($criteria)
            ->addOrderBy($orderBy)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->select('detail.id');

        $query = $builder->getQuery();

        $query->setHydrationMode($this->getResultMode());

        $paginator = $this->getManager()->createPaginator($query);

        //returns the total count of the query
        $totalResult = $paginator->count();

        //returns the variant data
        $variants = $paginator->getIterator()->getArrayCopy();


        $variantsIds = [];
        foreach ($variants as $key => $variant){
            $variantsIds[$key] = $variant['id'];
        }


        return ['data' => $variantsIds, 'total' => $totalResult];
    }
}