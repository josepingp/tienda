<?php
namespace Repositories;

require_once "./Lib/Db.php";
require_once "./Models/User.php";

use Lib\Db;
use Models\User;
use Models\rol;

class UsersRepository {
    
    private Db $conexion;

    public function __construct() {
        $this->conexion = new Db();
    }

    public function findAll(): ?array {
        $this->conexion->query("SELECT * FROM users");
        return $this->getAll();
    }

    public function get(): ?User {
        return ($user = $this->conexion->get()) ? User::fromArray( $user ) : null;
    }

    public function getAll(): ?array {
        $users = [];
        $usersData =  $this->conexion->getAll();

        foreach ($usersData as $user) {
            $users[] = User::fromArray($user);
        }
        return $users;
    }

}