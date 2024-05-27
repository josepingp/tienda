<?php
namespace Repositories;

use Lib\Db;
use Models\User;


class UsersRepository
{

    private Db $conexion;

    public function __construct()
    {
        $this->conexion = new Db();
    }

    public function findAllUsers(): ?array
    {
        $this->conexion->query("SELECT * FROM users");
        return $this->getAllUsers();
    }

    public function findUserByEmail(string $email): ?User
    {
        $this->conexion->query("SELECT * FROM users WHERE email = '$email'");
        // $user = $this->conexion->get();
        return $this->get();
    }


    public function get(): ?User
    {
        return ($user = $this->conexion->get()) ? User::fromArray($user) : null;
    }

    public function getAllUsers(): ?array
    {
        $users = [];
        $usersData = $this->conexion->getAll();

        foreach ($usersData as $user) {
            $users[] = User::fromArray($user);
        }
        return $users;
    }

    public function save(array $user): void
    {
        $fields = implode(",", array_keys($user['user']));
        $values = implode("', '", array_values($user['user']));

        $this->conexion->query("INSERT INTO users ($fields) VALUES ('$values')");
    }

}