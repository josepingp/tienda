<?php
namespace Controllers;

use Lib\AuthJWT;
use Services\ProductsService;
use Services\UsersService;
use Services\PaymentMethodsService;
use Lib\Pages;


class CheckoutController
{
    private UsersService $service;
    private Pages $pages;
    private AuthJWT $authJWT;
    private ProductsService $productsService;
    private PaymentMethodsService $paymentMethodsService;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->productsService = new ProductsService();
        $this->paymentMethodsService = new PaymentMethodsService();
        $this->pages = new Pages();
        $this->authJWT = new AuthJWT();
    }

    public function load()
    {
        $paymentMethods = $this->paymentMethodsService->getAll();
        
        
        if (isset($_SESSION['cart'])) {
            $ids = $_SESSION['cart'];            
            $products = $this->productsService->findProductsByIds($ids);

            $total = 0;
            if (isset($products)) {
                foreach($products as $product) {
                    $total += (int) $product['price'];
                }
            }


            if ($this->authJWT->accessState()) {                
                $user = $this->service->findUserByEmail($_SESSION['email']);
        
                $this->pages->render('checkout', ['user' => $user, 'total' => $total, 'paymentMethods' => $paymentMethods]);
            } else {
                $this->pages->render('checkout', [ 'total' => $total, 'paymentMethods' => $paymentMethods]);
            }
        } else {
            $this->pages->render('checkout');
        }
    }

}
