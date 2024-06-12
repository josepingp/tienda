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
        if ($this->authJWT->accessState()) {

            $user = $this->service->findUserByEmail($_SESSION['email']);
            $this->pages->render('home', ['user' => $user]);

        } else {
            $this->pages->render('home');

        }
    }

    public function log()
    {
        if (isset($_POST['session_close'])) {
            setcookie("jwt", "", time() - 3600, "/");
            setcookie("PHPSESSID", "", time() - 3600, "/");
            $this->pages->render('home');
        } else {
            $pass = DataCleaner::cleanString($_POST['pass']);
            $email = DataCleaner::cleanString($_POST['email']);
            if ($this->service->userVerify($email, $pass)) {
                ob_start();

                $user = $this->service->findUserByEmail($email);

                $_SESSION['name'] = $user->getName();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['rol'] = $user->getRol();

                //creo el JWT token
                $jwt = $this->authJWT->createSessionToken($user, './');
                //Lo meto en una cookie solo http
                //El identificador del usuario es el mail que esta en el sub del payload
                //El rol del usuario esta en el payload['rol']
                setcookie('JWT', $jwt['jwt'], $jwt['exp'], '/', '', true);
                $this->pages->render('home', ['user' => $user]);
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

    public function reg()
    {
        $this->pages->render('register');
    }
}