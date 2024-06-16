<?php

namespace Models;

class Category
{
    public function __construct(
        public string $id,
        public string $categoryName,
        public string $categoryDescription,
    ) {
    }

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

    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getCategoryDescription(): string
    {
        return $this->categoryDescription;
    }

    public function setCategoryDescription(string $categoryDescription): void
    {
        $this->categoryDescription = $categoryDescription;
    }

    public function fromArray(array $data): Category
    {
        return new Category(
            $data['id'],
            $data['category_name'],
            $data['category_description']
        );
    }
}

