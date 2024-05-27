<?php
namespace Services;

use Repositories\UsersRepository;
use Models\User;

class UsersService {

    private UsersRepository $repositories;

    public function __construct() {
        $this->repositories = new UsersRepository();
    }

    public function findAll(): ?array {
        return $this->repositories->findAllUsers();
    }

    public function findUserByEmail(string $email): ?User {
        return $this->repositories->findUserByEmail($email);
    }

    public function save(array $user): void {
        $this->repositories->save($user);
    }
}