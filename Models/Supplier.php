<?php

namespace Models;

class Supplier
{
    function __construct(
        private string $supplierName,
        private ?string $logo = null,
        private ?string $description = null,
    ) {
    }

    public function getSupplierName(): string
    {
        return $this->supplierName;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setSupplierName(string $supplierName): void
    {
        $this->supplierName = $supplierName;
    }

    public function setLogo(string $logo): ?string
    {
        $this->logo = $logo;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function fromArray(array $data): Supplier
    {
        return new Supplier($data["id"], $data["name"], $data['logo']);
    }

}