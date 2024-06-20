<?php
require_once "inc/autoloader.php";
require_once "./vendor/autoload.php";
require_once "config.php";

use Lib\Router;
use Controllers\AccountController;
use Controllers\BlogController;
use Controllers\HomeController;
use Controllers\SuppliersController;
use Controllers\AdminUsersController;
use Controllers\AdminProductsController;
use Controllers\ProductsContoller;
use Controllers\ContactController;
use Controllers\CartController;
use Controllers\CategoriesController;
use Controllers\CheckoutController;

session_start();
ob_start();



Router::add('GET', '/', function () {
    return (new HomeController())->load();
    // return 'el enrutador funciona';
});

Router::add('POST', "/", function () {
    return (new HomeController())->log();
    // return 'el enrutador funciona';
});

Router::add('GET', '/register', function() {
    return (new HomeController())->loadReg();
});

Router::add('POST', '/register', function() {
    return (new HomeController())->addReg();
});

Router::add('GET', '/products', function() {
    return (new ProductsContoller())->load();
});

Router::add('GET', '/my_account', function() {
    return (new AccountController())->load();
});

Router::add('GET', '/products/:id', function ($category) {
    return (new ProductsContoller())->listCategory($category);
});

Router::add('POST', '/products/:id', function () {
    return (new ProductsContoller())->addProductToCart();
});

Router::add('GET', '/checkout', function() {
    return (new CheckoutController())->load();
});

Router::add('POST', '/checkout', function() {
    return (new CheckoutController())->pay();
});

Router::add('GET', '/blog', function () {
    return (new BlogController())->load();
});

Router::add('GET', '/contact', function () {
    return (new ContactController())->load();
});

Router::add('GET', '/cart', function () {
    return (new CartController())->load();
});

Router::add('GET', '/admin_products', function() {
    return (new AdminProductsController())->list();
});

Router::add('GET', '/admin_products/new_product', function() {
    return (new AdminProductsController())->addProduct();
});

Router::add('GET', '/admin_products/new_supplier', function() {
    return (new SuppliersController())->addSupplier();
});

Router::add('GET', '/admin_products/new_category', function() {
    return (new CategoriesController())->addCategory();
});

Router::add('POST', '/admin_products/new_product', function () {
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



