<?php

namespace Solutions\Modules\Solutions\Repository;

use Solutions\Factory\QueryFactory;
use Solutions\Modules\Solutions\Entity\Category\Category;

/**
 * Repository.
 */
final class CategoryRepository
{
    private QueryFactory $queryFactory;

    /**
     * The constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     */
    public function __construct(QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
    }

    public function insertCategory(Category $category)
    {
        $data['id'] = $category->getId();
        $data['title'] = $category->getTitle();
        $data['created_at'] = $category->getCreatedAt();

        // создание категории
        $this->queryFactory->newInsert('category', $data);
    }
}