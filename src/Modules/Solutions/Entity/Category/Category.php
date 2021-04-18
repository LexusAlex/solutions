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

    public function __construct(Id $id, Title $title, DateTimeImmutable $created_at)
    {
        $this->id = $id;
        $this->title = $title;
        $this->created_at = $created_at;
        //$reader = new ArrayReader($data);
        //$this->id = $reader->findInt('id');
        //$this->title = $reader->findString('title');
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

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->created_at->getTimestamp();
    }

    #[Pure] public static function addCategory(
        Id $id,
        Title $title,
        DateTimeImmutable $created_at,
    ): self {
        $category = new self($id, $title, $created_at);
        return $category;
    }
}