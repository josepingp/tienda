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

    public function findUserById(int $Id): ?User {
        return $this->repositories->findUserById($Id);
    }

    public function save(array $user): void {
        $this->repositories->save($user);
    }

    public function userVerify(string $mail, string $pass): bool
    {
        $user = $this->repositories->findUserByEmail($mail);
        if (!is_null($user)){
            return password_verify($pass, $user->getPass());
        } else {
            return false;
        }
    }

    public function updatePhone($user, $phone)
    {
        $userData = [
            'phone' => $phone,
            'id' => $user->getId()
        ];
        $this->save($userData);
    }
}