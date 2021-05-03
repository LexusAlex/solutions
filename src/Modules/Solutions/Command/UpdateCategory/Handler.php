<?php

declare(strict_types=1);

namespace Solutions\Modules\Solutions\Command\UpdateCategory;

use DateTimeImmutable;
use Solutions\Modules\Solutions\Entity\Category\Category;
use Solutions\Modules\Solutions\Entity\Category\Id;
use Solutions\Modules\Solutions\Entity\Category\ParentId;
use Solutions\Modules\Solutions\Entity\Category\Title;
use Solutions\Modules\Solutions\Repository\CategoryRepository;

final class Handler
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(Command $command, array $data = []): void
    {
        $title = new Title($command->title);
        $parent_id = new ParentId($command->parent_id);

        $category = Category::updateCategory(
            $data['id'],
            $title,
            $data['created_at'],
            $parent_id
        );

        $this->categoryRepository->updateCategory($category);
    }
}