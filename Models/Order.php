<?php

namespace Models;

class Order
{
    public function __construct(
        private string $id,
        private string $orderCode,
        private string $userId,
        private string $orderDate,
        private string $orderTotalAmount,
        private string $paymentMethodId,
        private string $statusId
    ) {
    }

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getOrderCode(): string
    {
        return (string) $this->orderCode;
    }

    public function setOrderCode(string $orderCode): void
    {
        $this->orderCode = $orderCode;
    }

    public function getUserId(): int
    {
        return (int) $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getOrderDate(): string
    {
        return (string) $this->orderDate;
    }

    public function setOrderDate(string $orderDate): void
    {
        $this->orderDate = $orderDate;
    }

    public function getOrderTotalAmount(): float
    {
        return (float) $this->orderTotalAmount;
    }

    public function setOrderTotalAmount(float $orderTotalAmount): void
    {
        $this->orderTotalAmount = $orderTotalAmount;
    }

    public function getPaymentMethodId(): int
    {
        return (int) $this->paymentMethodId;
    }

    public function setPaymentMethodId(int $paymentMethodId): void
    {
        $this->paymentMethodId = $paymentMethodId;
    }

    public function getStatusId(): int
    {
        return (int) $this->statusId;
    }

    public function setStatusId(int $statusId): void
    {
        $this->statusId = $statusId;
    }

    public static function fromArray(array $data) : Order
    {
        return new Order(
            $data["id"],
            $data["order_code"],
            $data["user_id"],
            $data["order_date"],
            $data["order_total_amount"],
            $data["payment_method_id"],
            $data["status_id"]
        );
    }
}