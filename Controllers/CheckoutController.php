<?php
namespace Controllers;

use Lib\AuthJWT;
use Services\DirectionsService;
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
    private DirectionsService $directionsService;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->productsService = new ProductsService();
        $this->paymentMethodsService = new PaymentMethodsService();
        $this->directionsService = new DirectionsService();
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
                $directions = $this->directionsService->getAllByUserId($user->getId());

        
                $this->pages->render('checkout', [
                                                    'user' => $user,
                                                    'total' => $total,
                                                    'paymentMethods' => $paymentMethods,
                                                    'directions' => $directions
                                                ]);
            } else {
                $this->pages->render('checkout', [
                                                    'total' => $total,
                                                    'paymentMethods' => $paymentMethods,
                                                    ]);
            }
        } else {
            header('Location: /proyecto/');
        }
    }

    public function pay()
    {
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
                if ($user->getPhone() == '' ) {
                    $userData = [
                        'phone' => $_POST['phone'],
                        'id' => $user->getId()
                    ];

                    $this->service->save($userData);
                }

                if (!isset($_POST['shpping_address_id'])) {
                    $street = $_POST['street'];
                    $number = $_POST['shipping-number'];
                    $floor = $_POST['floor'];
                    $apartment = $_POST['apartment'];
                    $city = $_POST['region'];
                    $user_id = $user->getId();
                    $isMain = (isset($_POST['main'])) ? true : false; 

                    $direction = [
                        'street' => $street,
                        'number' => $number,
                        'floor' => $floor,
                        'apartment' => $apartment,
                        'city' => $city,
                        'user_id' => $user_id,
                        'is_main' => $isMain
                    ];


                    $this->directionsService->save($direction);
                }
                
                
                
                
                $this->pages->render('checkout', ['user' => $user, 'total' => $total]);
        
            } else {
                $this->pages->render('checkout', [ 'total' => $total]);
            }

            // header('Location: /proyecto/');
        }
    }

}
