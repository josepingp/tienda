<?php
namespace Models;

class Rol
{
    public function __construct(
        private string $id,
        private string $role_name
    ) {
    }

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setRoleName(string $role_name): void
    {
        $this->role_name = $role_name;
    }

    public function getRoleName(): string
    {
        return $this->role_name;
    }

    public static function fromArray(array $data): Rol
    {
        return new Rol($data['id'], $data['role_name']);
    }
}