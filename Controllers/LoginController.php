<?php
namespace Controllers;

Use Lib\AuthJWT;
use Services\UsersService;
use Lib\Pages;
use Utils\DataCleaner;

class LoginController
{
    private UsersService $userService;
    private Pages $pages;
    private AuthJWT $authJWT;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->pages = new Pages();
        $this->authJWT = new AuthJWT();
    }

    public function log() 
    {
        
        $_SESSION['name'] = $_POST['email'];
        $this->authJWT->setCoki();
        $this->pages->render('home');
        // header('Location: /proyecto/');
    }
}
