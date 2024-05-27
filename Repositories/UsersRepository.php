<?php
namespace Repositories;

use Lib\Db;
use Models\User;


class UsersRepository {
    
    private Db $conexion;

    public function __construct() {
        $this->conexion = new Db();
    }

    public function findAllUsers(): ?array {
        $this->conexion->query("SELECT * FROM users");
        return $this->getAllUsers();
    }

    public function get(): ?User {
        return ($user = $this->conexion->get()) ? User::fromArray( $user ) : null;
    }

    public function getAllUsers(): ?array {
        $users = [];
        $usersData =  $this->conexion->getAll();

        foreach ($usersData as $user) {
            $users[] = User::fromArray($user);
        }
        return $users;
    }

}