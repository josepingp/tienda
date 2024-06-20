<?php
namespace Controllers;

use Lib\AuthJWT;
use Lib\Paypal;
use Services\CartService;
use Services\DirectionsService;
use Services\OrderDetailsService;
use Services\OrderService;
use Services\ProductsService;
use Services\UsersService;
use Services\PaymentMethodsService;
use Lib\Pages;


class CheckoutController
{
    private UsersService $service;
    private Pages $pages;
    private AuthJWT $authJWT;
    private Paypal $paypal;
    private ProductsService $productsService;
    private PaymentMethodsService $paymentMethodsService;
    private DirectionsService $directionsService;
    private OrderService $orderService;
    private OrderDetailsService $orderDetailsService;
    private CartService $cartService;


    public function __construct()
    {
        $this->service = new UsersService();
        $this->productsService = new ProductsService();
        $this->paymentMethodsService = new PaymentMethodsService();
        $this->directionsService = new DirectionsService();
        $this->orderService = new OrderService();
        $this->orderDetailsService = new OrderDetailsService();
        $this->cartService = new CartService();
        $this->pages = new Pages();
        $this->authJWT = new AuthJWT();
        $this->paypal = new Paypal();

    }

    public function load()
    {
        $paymentMethods = $this->paymentMethodsService->getAll();
        
        if (isset($_SESSION['cart'])) {         
            $products = $this->productsService->findProductsByIds($_SESSION['cart']);
            $total = $this->cartService->calculateTotal($products);

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
            $products = $this->productsService->findProductsByIds($_SESSION['cart']);
            $total = $this->cartService->calculateTotal($products);
            
            if ($this->authJWT->accessState()) {                
                $user = $this->service->findUserByEmail($_SESSION['email']);
            } else {
                $user = [
                    'name' => $_POST['name'],
                    'last_name1' => $_POST['last_name1'],
                    'last_name2' => $_POST['last_name2'],
                    'email' => $_POST['email'],
                    'password' => 'invitado',
                    'birth_date' => $_POST['birth_date'],
                    'date_registered' => date('Y-m-d_H-i-s'),
                    'role_id' => 3
                ];

                $this->service->save($user);
                
                $user = $this->service->findUserByEmail($_POST['email']);
            }
            
            if ($user->getPhone() == '' ) {
                    $this->service->updatePhone($user, $_POST['phone']);
                }

                if (!isset($_POST['shipping_address_id'])) {
                    $directionId = $this->directionsService->createShippingAddress($user, $total);
                    $direction = $_POST['street'] .', '. $_POST['city']; 
                } else {
                    $directionId = $_POST['shipping_address_id'];
                    $direction = $this->directionsService->getDirectionById($directionId);
                    $direction = $direction['street'] . ', ' . $direction['city']; 
                }
                
                $orderCode = $this->orderService->orderCode();
                $userId = $user->getId();
                $orderDate = date('Y-m-d_H-i-s');
                $paymentMethod = $_POST["payment_method"];

                $orderId = $this->orderService->create([
                    'order_code' => $orderCode,
                    'user_id' => $userId,
                    'shipping_address_id' => $directionId,
                    'order_date' => $orderDate,
                    'order_total_amount' => $total,
                    'payment_method_id' => $paymentMethod,
                    'status_id' => 1
                ]);

                $details = [];
                foreach ($products as $product) {
                    $details[] = [
                        'order_id' => $orderId,
                        'product_id' => $product['id'],
                        'quantity' => 1,
                        'unit_price' => $product['price'],
                        'total_price' => $product['price'] * 1
                    ];
                }

                $this->orderDetailsService->createOrderDetails($details);

                $this->paypal->tokenControl();
                $draft = $this->paypal->createDraftInvoice($user, $products, $orderId, $direction);

                $msg = '<h2>Su compra se ha realizado con éxito.</h2>';

                echo $msg;



            // header('Location: /proyecto/');
        }
    }

}