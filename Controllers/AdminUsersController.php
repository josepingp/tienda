<?php
namespace Controllers;

use Services\RolesService;
use Services\UsersService;
use Lib\Pages;

class AdminUsersController
{
    private UsersService $service;
    private RolesService $rolesService;
    private Pages $pages;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->rolesService = new RolesService();
        $this->pages = new Pages();
    }

    public function list()
    {
        $users = $this->service->findAll();
        $this->pages->render('admin_users', ['users'=> $users]);
    }

    public function add(): void
    {
        $roles = $this->rolesService->getAll();
        $this->pages->render('new_user', ['roles' => $roles]);
    }
}