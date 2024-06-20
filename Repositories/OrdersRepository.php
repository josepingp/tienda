<?php
namespace Repositories;

use Lib\Db;

class OrdersRepository
{
    private Db $conexion;

    public function __construct()
    {
        $this->conexion = new Db();
    }

    public function create(array $order): int
    {
        $fields = implode(",", array_keys($order));
        $values = implode("', '", array_values($order));

        $this->conexion->query("INSERT INTO orders ($fields) VALUES ('$values')");

        return $this->conexion->lastId();
    }

    public function orderCode(): int
    {
        $this->conexion->query("SELECT count(id) FROM orders");
        return $this->conexion->get()["count(id)"] + 1;
    }

}
