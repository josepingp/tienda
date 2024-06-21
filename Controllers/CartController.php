<?php
namespace Controllers;

use Lib\AuthJWT;
use Services\CartService;
use Services\ProductsService;
use Services\UsersService;
use Lib\Pages;


class CartController
{
    private UsersService $service;
    private Pages $pages;
    private AuthJWT $authJWT;
    private ProductsService $productsService;
    private CartService $cartService;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->productsService = new ProductsService();
        $this->cartService = new CartService();
        $this->pages = new Pages();
        $this->authJWT = new AuthJWT();
    }


    public function load()
    {
        if (isset($_SESSION['cart'])) {        
            $products = $this->productsService->findProductsByIds($_SESSION['cart']);
            $products = $this->cartService->countProducts();

            if ($this->authJWT->accessState()) {                
                $user = $this->service->findUserByEmail($_SESSION['email']);
                $this->pages->render('cart', ['user' => $user, 'products' => $products]);
            } else {
                $this->pages->render('cart', ['products' => $products]);
            }
        } else {
            $this->pages->render('cart');
        }
    }
}