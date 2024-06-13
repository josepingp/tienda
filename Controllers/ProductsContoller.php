<?php
namespace Controllers;

use Lib\AuthJWT;
use Services\UsersService;
use Lib\Pages;

class ProductsContoller
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
            $this->pages->render('products', ['user' => $user]);

        } else {
            $this->pages->render('products');

        }
    }

    public function listCategory($category)
    {
        if ($this->authJWT->accessState()) {

            $categories = [
                '1' => 'MODA',
                '2' => 'ZAFUS',
                '3' => 'ESTERILLAS',
                '4' => 'MANTAS',
                '5' => 'ACCESORIOS',
                '6' => 'MEDITACION',
            ];

            $category = $categories[$category];

            $user = $this->service->findUserByEmail($_SESSION['email']);
            $this->pages->render('products', ['user' => $user, 'category' => $category]);

        } else {
            $categories = [
                '1' => 'MODA',
                '2' => 'ZAFUS',
                '3' => 'ESTERILLAS',
                '4' => 'MANTAS',
                '5' => 'ACCESORIOS',
                '6' => 'MEDITACION',
            ];

            $category = $categories[$category];
            $this->pages->render('products', ['category' => $category]);


        }
    }
}