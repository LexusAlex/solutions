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
        $data['parent_id'] = $category->getParentId();

        $this->queryFactory->newInsert('category', $data);
    }

    public function updateCategory(Category $category)
    {
        $data['id'] = $category->getId();
        $data['title'] = $category->getTitle();
        $data['created_at'] = $category->getCreatedAt();
        $data['parent_id'] = $category->getParentId();

        $this->queryFactory->newUpdate('category', $data);
    }

    public function getCategories(): array
    {
        return $this->queryFactory->newSelectAll('category');
    }

    public function getCategory(string $id): object
    {
        return $this->queryFactory->newSelectOne('category', $id);
    }
}