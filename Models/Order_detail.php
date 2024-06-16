<?php 

namespace Models;

class Order_detail{
    public function __construct(
        private string $id,
        private string $orderID,
        private string $product_id,
        private string $quantity,
        private string $unitPrice,
        private string $totalPrice 
    ){}

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getOrderId(): int
    {
        return (int) $this->orderID;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getProductId(): int
    {
        return (int) $this->product_id;
    }

    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    public function getQuantity(): int
    {
        return (int) $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getUnitPrice(): float
    {
        return (float) $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function getTotalPrice(): float
    {
        return (float) $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    public static function fromArray(array $data) :Order_detail
    {
        return new Order_detail(
            $data["id"],
            $data["oreder_id"],
            $data["product_id"],
            $data['quantity'],
            $data['unit_price'],
            $data['total_price']
        );
    }

}