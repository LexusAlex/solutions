<?php

declare(strict_types=1);

namespace Solutions\Modules\Solutions\Entity\Category;

use DateTimeImmutable;
use JetBrains\PhpStorm\Pure;

final class Category
{
    private Id $id;
    private Title $title;
    private DateTimeImmutable $created_at;
    private ParentId $parent_id;

    public function __construct(Id $id, Title $title, DateTimeImmutable $created_at, ParentId $parent_id)
    {
        $this->id = $id;
        $this->title = $title;
        $this->created_at = $created_at;
        $this->parent_id = $parent_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title->getValue();
    }

    public function getId(): string
    {
        return $this->id->getValue();
    }

    public function getParentId(): string
    {
        return $this->parent_id->getValue();
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    #[Pure] public static function addCategory(
        Id $id,
        Title $title,
        DateTimeImmutable $created_at,
        ParentId $parent_id
    ): self {
        return new self($id, $title, $created_at, $parent_id);
    }

    #[Pure] public static function updateCategory(
        Id $id,
        Title $title,
        DateTimeImmutable $created_at,
        ParentId $parent_id
    ): self {
        return new self($id, $title, $created_at, $parent_id);
    }
}