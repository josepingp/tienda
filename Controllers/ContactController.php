<?php
namespace Controllers;

use Lib\AuthJWT;
use Services\UsersService;
use Lib\Pages;

class ContactController
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
            $this->pages->render('contact', ['user' => $user]);

        } else {
            $this->pages->render('contact');

        }
    }
}