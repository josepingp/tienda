<?php
namespace Services;

use Repositories\UsersRepository;

class UsersService {

    private UsersRepository $repositories;

    public function __construct() {
        $this->repositories = new UsersRepository();
    }

    public function findAll(): ?array {
        return $this->repositories->findAllUsers();
    }
}