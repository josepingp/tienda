<?php
namespace Controllers;

use Lib\AuthJWT;
use Services\UsersService;
use Lib\Pages;
use Utils\DataCleaner;

class HomeController
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
        // $this->authJWT->setCoki();
        $this->pages->render('home');
    }

    public function log()
    {
        $pass = DataCleaner::cleanString($_POST['pass']);
        $email = DataCleaner::cleanString($_POST['email']);

        if ($this->service->userVerify($email, $pass)) {

            $user = $this->service->findUserByEmail($email);

            session_start();
            $_SESSION['name'] = $user->getName();

            //creo el JWT token
            $jwt = $this->authJWT->createSessionToken($user, './');
            //Lo meto en una cookie solo http
            //El identificador del usuario es el mail que esta en el sub del payload
            //El rol del usuario esta en el payload['rol']
            setcookie('JWT', $jwt['jwt'], $jwt['exp'], '/', '', true );

            $this->pages->render('home');
        } else {
            $msg = '
            <div>
                <strong>¡Ocurrio un error!</strong><br>
                El Usuario o la contraseña no son correctos.
            </div>';
            $this->pages->render('home', ['msg' => $msg]);
        }
    }
}
