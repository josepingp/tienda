<?php
namespace Services;

use Repositories\OrdersRepository;

class OrderService
{
    private OrdersRepository $repo;

    public function __construct()
    {
        $this->repo = new OrdersRepository();
    }

    public function create(array $order): ?int
    {
        return $this->repo->create($order);
    }

    public function orderCode(): int
    {
        return $this->repo->orderCode();
    }
}
