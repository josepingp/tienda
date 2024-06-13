<?php
namespace Controllers;

use Lib\AuthJWT;
use Services\UsersService;
use Lib\Pages;
use Utils\DataCleaner;


class AccountController
{
    private UsersService $service;
    private Pages $pages;
    private AuthJWT $authJWT;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->pages = new Pages();
        $this->authJWT = new AuthJWT();
    }


    public function load()
    {
        if ($this->authJWT->accessState()) {

            $user = $this->service->findUserByEmail($_SESSION['email']);
            $this->pages->render('my_account', ['user' => $user]);

        } else {
            header('Location: /proyecto');

        }
    }
}