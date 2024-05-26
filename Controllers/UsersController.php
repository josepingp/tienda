<?php
namespace Controllers;

require_once "./Lib/pages.php";
require_once "./Services/UsersService.php";


use Services\UsersService;
use Lib\Pages;

class UsersController
{
    private UsersService $service;
    private Pages $pages;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->pages = new Pages();
    }

    public function list()
    {
        $users = $this->service->findAll();
        $this->pages->render('admin_users', ['users'=> $users]);
    }

    public function add(): void
    {
        $this->pages->render('new_user');
    }
}