

<?php
// require_once "./inc/navbar.php"; 
require_once "./inc/autoloader.php";
require_once "config.php";
// require_once './App/Lib/Router.php';
// require_once "./Models/User.php";

use Lib\Db;
use Lib\Router;
use Controllers\UsersController;
use Models\User;

// $cnx = new Db();
// $cnx->query("SELECT * FROM users");
// $user = $cnx->get();
// var_dump($user);
// $user = User::fromArray($user);
// var_dump($user);



Router::add('GET', '/admin_users', function () {
    return (new UsersController())->list();
    // return 'el enrutador funciona';
});

Router::add('GET', '/admin_users/new_user', function () {
    return (new UsersController())->add();
    // return 'el enrutador funciona';
});

Router::dispatch();





?>







