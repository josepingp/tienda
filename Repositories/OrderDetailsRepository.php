<?php
namespace Repositories;

use Lib\Db;

class OrderDetailsRepository
{
    private Db $conexion;

    public function __construct()
    {
        $this->conexion = new Db();
    }

    public function createOrderDetails(array $details): void
    {
        $fields = implode(", ", array_keys($details[0]));
        

        foreach ($details as $value) {
            $values[] = "('" . implode("', '", array_values($value)) . "')";
        }

        $values = implode(", ", $values);
        $this->conexion->query("INSERT INTO order_details ($fields) VALUES $values");
    }


}
