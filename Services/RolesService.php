<?php
namespace Services;

use Repositories\RolesRepository;

class RolesService {
    private RolesRepository $repo;

    public function __construct(){
        $this->repo = new RolesRepository();
    }

    public function getAll() {
        return $this->repo->findAllRoles();
    }
}