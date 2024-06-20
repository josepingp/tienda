<?php
namespace Services;

use Repositories\OrderDetailsRepository;

class OrderDetailsService {
    private OrderDetailsRepository $repo;

    public function __construct(){
        $this->repo = new OrderDetailsRepository();
    }

    public function createOrderDetails($details) {
        return $this->repo->createOrderDetails($details);
    }

}