<?php
namespace Controllers;

use Lib\Pages;
use Lib\AuthJWT;
use Services\UsersService;


class SuppliersController
{
    private Pages $pages;
    private UsersService $service;
    private AuthJWT $authJWT;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->pages = new Pages();
        $this->authJWT = new AuthJWT();
    }

public function addSupplier()
    {
        if ($this->authJWT->accessState()) {
            $user = $this->service->findUserByEmail($_SESSION['email']);

            $this->pages->render('new_supplier', [
                'user' => $user
            ]);
        } else {
            header('Location: /proyecto/');
        }
    }

}