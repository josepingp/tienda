<?php
namespace Services;

use Repositories\OrderDetailsRepository;

class OrderDetailsService
{
    private OrderDetailsRepository $repo;

    public function __construct()
    {
        $this->repo = new OrderDetailsRepository();
    }

    public function insertOrderDetails(array $products, $orderId): void
    {
        $details = $this->createDetails($products, $orderId);
        $this->repo->createOrderDetails($details);
    }

    private function createDetails(array $products, $orderId): array
    {
        $details = [];
        foreach ($products as $product) {
            $details[] = [
                'order_id' => $orderId,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'unit_price' => $product['price'],
                'total_price' => $product['price'] * $product['quantity']
            ];
        }

        return $details;
    }

}