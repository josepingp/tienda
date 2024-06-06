<?php

namespace Models;

class OrderStatus {

    public function __construct(
        private string $id,
        private string $statusName,
        private string $statusDescription
    ) {}

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getStatusName(): string
    {
        return (string) $this->statusName;
    }

    public function setStatusName(string $statusName): void
    {
        $this->statusName = $statusName;
    }

    public function getStatusDescription(): string
    {
        return (string) $this->statusDescription;
    }

    public function setStatusDescription(string $statusDescription): void
    {
        $this->statusDescription = $statusDescription;
    }

    public static function fromArray(array $data) : OrderStatus
    {
        return new OrderStatus(
            $data["id"],
            $data["status_name"],
            $data["status_description"]
        );
    }
}