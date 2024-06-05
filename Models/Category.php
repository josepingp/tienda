<?php

namespace Models;

class Category
{
    public function __construct(
        public string $id,
        public string $categoryName,
        public string $categoryDescription,
    ){}

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryName(): string
    {
        return (string) $this->categoryName;
    }
}