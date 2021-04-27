<?php

declare(strict_types=1);

namespace Solutions\Modules\Solutions\Query\GetCategories;

use Solutions\Modules\Solutions\Repository\CategoryRepository;

final class GetCategories
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(): array
    {
        return $this->categoryRepository->getCategories();
    }
}