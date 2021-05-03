<?php

declare(strict_types=1);

namespace Solutions\Modules\Solutions\Query\GetCategory;

use Solutions\Modules\Solutions\Repository\CategoryRepository;

final class GetCategory
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(string $id): object
    {
        return $this->categoryRepository->getCategory($id);
    }
}