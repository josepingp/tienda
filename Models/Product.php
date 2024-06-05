<?php

namespace Models;

class Product {

public function __construct(
    private string $id,
    private string $productCode,
    private string $name,
    private string $description,
    private string $price,
    private string $stock,
    private string $categoryId,
    private string $supplierId,
    private bool $isOutstanding = false
) {}

public function getId(): int {
    return (int) $this->id;
}

public function setId(int $id): void
{
    $this->id = $id;
}

public function getProductCode(): string
{
    return (string) $this->productCode;
}

public function setProductCode(string $productCode): void
{
    $this->productCode = $productCode;
}

public function getName(): string
{
    return (string) $this->name;
}

public function setName(string $name): void
{
    $this->name = $name;
}

public function getDescription(): string
{
    return (string) $this->description;
}

public function setDescription(string $description): void
{
    $this->description = $description;
}

public function getPrice(): float
{
    return (float) $this->price;
}

public function setPrice(float $price): void
{
    $this->price = $price;
}

public function getStock(): int
{
    return (int) $this->stock;
}

public function setStock(int $stock): void
{
    $this->stock = $stock;
}

public function getCategoryId(): int
{
    return (int) $this->categoryId;
}

public function setCategoryId(int $categoryId): void
{
    $this->categoryId = $categoryId;
}

public function getSupplierId(): int
{
    return (int) $this->supplierId;
}

public function setSupplierId(int $supplierId): void
{
    $this->supplierId = $supplierId;
}

public function getIsOutstanding(): bool
{
    return $this->isOutstanding;
}

public function setIsOutstandin(bool $isOutstanding)
{
    $this->isOutstanding = $isOutstanding;
}

public static function fromArray(array $data) :Product
    {
        return new Product(
            $data["id"],
            $data["product_code"],
            $data["name"],
            $data['description'],
            $data['price'],
            $data['stock'],
            $data['category_id'],
            $data['supplier_id'],
            $data['is_outstanding']
        );
    }
}