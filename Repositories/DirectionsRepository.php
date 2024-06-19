<?php
namespace Repositories;

use Lib\Db;

class DirectionsRepository
{
    private Db $conexion;

    public function __construct()
    {
        $this->conexion = new Db();
    }

    public function findDirectionsByUserId($id)
    {
        $this->conexion->query("SELECT * FROM shipping_addresses WHERE user_id = $id");
        return $this->conexion->getAll();
    }

    public function save(array $direction): void 
    {
        $fields = implode(",", array_keys($direction));
        $values = implode("', '", array_values($direction));

        $this->conexion->query("INSERT INTO shipping_addresses ($fields) VALUES ('$values')");
    }

}


