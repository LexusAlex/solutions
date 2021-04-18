<?php

declare(strict_types=1);

namespace Solutions\Modules\Solutions\Command\AddCategory;

use DateTimeImmutable;
use Solutions\Modules\Solutions\Entity\Category\Category;
use Solutions\Modules\Solutions\Entity\Category\Id;
use Solutions\Modules\Solutions\Entity\Category\Title;
use Solutions\Modules\Solutions\Repository\CategoryRepository;

final class Handler
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(Command $command): void
    {
        $title = new Title($command->title);
        $created_at = new DateTimeImmutable();

        $category = Category::addCategory(
            Id::generate(),
            $title,
            $created_at,
        );

        $this->categoryRepository->insertCategory($category);
    }
}