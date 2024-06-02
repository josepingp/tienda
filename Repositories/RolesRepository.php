<?php

namespace Repositories;

use Lib\Db;
Use Models\Rol;

class RolesRepository {

    private Db $conexion;

public function __construct(){
    $this->conexion = new Db();
}

    public function findAllRoles(): ?array {
        $this->conexion->query("SELECT * FROM roles");
        return $this->getAllRoles();
    }

    public function get(): ?Rol {
        return ($rol = $this->conexion->get()) ? Rol::fromArray( $rol ) : null;
    }

    public function getAllRoles(): ?array {
        $roles = [];
        $rolesData =  $this->conexion->getAll();

        foreach ($rolesData as $rol) {
            $roles[] = Rol::fromArray($rol);
        }
        return $roles;
    }

}

