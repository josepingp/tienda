<?php
namespace Services;

use Repositories\PaymentMethodsRepository;

class PaymentMethodsService {
    private PaymentMethodsRepository $repo;

    public function __construct(){
        $this->repo = new PaymentMethodsRepository();
    }

    public function getAll() {
        return $this->repo->findAllPaymentMethods();
    }
}