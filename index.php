<?php
include "pages/header.php";

require_once "./inc/autoloader.php";
require_once "config.php";

use Lib\Router;
use Controllers\AdminUsersController;


Router::add('GET', '/admin_users', function () {
    return (new AdminUsersController())->list();
    // return 'el enrutador funciona';
});

Router::add('GET', '/admin_users/new_user', function () {
    return (new AdminUsersController())->add();
    // return 'el enrutador funciona';
});

Router::add('POST', '/admin_users/new_user', function () {
    return (new AdminUsersController())->SaveUser();
    // return 'el enrutador funciona';
});

Router::dispatch();



