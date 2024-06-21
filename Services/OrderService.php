<?php
namespace Services;

use Repositories\OrdersRepository;
use Models\User;

class OrderService
{
    private OrdersRepository $repo;

    public function __construct()
    {
        $this->repo = new OrdersRepository();
    }

    public function create(User $user, int $directionId, mixed $total): ?int
    {
        $order = [
            'order_code' => $this->orderCode(),
            'user_id' => $user->getId(),
            'shipping_address_id' => $directionId,
            'order_date' => date('Y-m-d_H-i-s'),
            'order_total_amount' => $total,
            'payment_method_id' => $_POST["payment_method"],
            'status_id' => 1
        ];
        return $this->repo->create($order);
    }

    private function orderCode(): int
    {
        return $this->repo->orderCode();
    }
}
