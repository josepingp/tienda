<?php
namespace Lib;
use mysqli;

class Db {

    private mysqli $conexion;
    private mixed $response;
    
    function __construct(
        private string $host = HOST,
        private string $user = USER,
        private string $password = PASS,
        private string $dbname = DB,
    ) {
        $this->conexion = $this->conect();
    }

    private function conect(): mysqli {
        $conexion = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if ($conexion->connect_error) {
            die("Error en la conexion");
        } 
        return $conexion;
    }

    public function prepare($sql): mixed
    {
        return $this->conexion->prepare($sql);
    }

    public function query(string $sql): void {
        $this->response = $this->conexion->query($sql);
    }

    public function get(): mixed {
        return ($row = $this->response->fetch_array(MYSQLI_ASSOC)) ? $row : null;
    }

    public function getAll(): array {
        return $this->response->fetch_all(MYSQLI_ASSOC);
    }

    public function lastId(): int
    {
        return $this->conexion->insert_id;
    }
}