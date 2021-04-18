<?php

declare(strict_types=1);

namespace Solutions\Modules\Solutions\Query\getCategories;

use Solutions\Modules\Solutions\Repository\CategoryRepository;

final class Handler
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