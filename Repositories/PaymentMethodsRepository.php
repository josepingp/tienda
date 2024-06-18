<?php
namespace Repositories;

use Lib\Db;

class PaymentMethodsRepository
{
    private Db $conexion;

    public function __construct()
    {
        $this->conexion = new Db();
    }

    public function findAllPaymentMethods()
    {
        $this->conexion->query("SELECT * FROM payment_methods");
        return $this->conexion->getAll();
    }

}
