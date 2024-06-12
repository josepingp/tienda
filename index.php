<?php
require_once "./inc/autoloader.php";
require_once "./vendor/autoload.php";
require_once "config.php";

use Controllers\HomeController;
use Lib\Router;
use Controllers\AdminUsersController;
use Controllers\AdminProductsController;

session_start();



Router::add('GET', '/', function () {
    return (new HomeController())->load();
    // return 'el enrutador funciona';
});

Router::add('POST', "/", function () {
    return (new HomeController())->log();
    // return 'el enrutador funciona';
});

Router::add('GET', '/register', function() {
    return (new HomeController())->reg();
});

Router::add('GET', '/admin_products', function() {
    return (new AdminProductsController())->list();
});

Router::add('GET', '/admin_products/product', function() {
    return (new AdminProductsController())->addProduct();
});

Router::add('POST', '/admin_products/product', function() {
    return (new AdminProductsController())->saveProduct();
});

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

Router::add('POST', '/admin_users/user/:id', function () {
    return (new AdminUsersController())->SaveUser();
    // return 'el enrutador funciona';
});

Router::add('GET', '/admin_users/new_user/:id', function ($userId) {
    return (new AdminUsersController())->editUser($userId);
    // return 'el enrutador funciona';
});

Router::dispatch();



