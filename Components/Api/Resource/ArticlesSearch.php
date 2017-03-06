<?php

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Exception as ApiException;
use Shopware\Components\Api\Resource\Article as ArticleResource;

/**
 * Class ArticlesSearch
 *
 * @package Shopware\Components\Api\Resource
 */
class ArticlesSearch extends ArticleResource
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

        $builder = $this->getRepository()->createQueryBuilder('article');

        $builder->addFilter($criteria)
            ->addOrderBy($orderBy)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->select('article.id');

        $query = $builder->getQuery();

        $query->setHydrationMode($this->getResultMode());

        $paginator = $this->getManager()->createPaginator($query);

        //returns the total count of the query
        $totalResult = $paginator->count();

        //returns the article data
        $articles = $paginator->getIterator()->getArrayCopy();

        if ($this->getResultMode() === self::HYDRATE_ARRAY
            && isset($options['language'])
            && !empty($options['language'])
        ) {

            /**@var $shop Shop */
            $shop = $this->findEntityByConditions('Shopware\Models\Shop\Shop', [
                ['id' => $options['language']]
            ]);

            foreach ($articles as &$article) {
                $article = $this->translateArticle(
                    $article,
                    $shop
                );
            }
        }

        $articlesIds = [];
        foreach ($articles as $key => $article){
            $articlesIds[$key] = $article['id'];
        }


        return ['data' => $articlesIds, 'total' => $totalResult];
    }
}
