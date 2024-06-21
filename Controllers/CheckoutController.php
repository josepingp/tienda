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
            $products = $this->cartService->countProducts();
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
                $this->pages->render('checkout', ['total' => $total, 'paymentMethods' => $paymentMethods]);
            }
        } else {
            header('Location: /proyecto/');
        }
    }

    public function pay()
    {
        if (isset($_SESSION['cart'])) {
            $products = $this->cartService->countProducts();
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

            if ($user->getPhone() == '') {
                if ($_POST['phone'] == '' || !isset($_POST['phone'])) {
                    $this->load();
                }
                $this->service->updatePhone($user, $_POST['phone']);
            }

            if (!isset($_POST['shipping_address_id'])) {
                $directionId = $this->directionsService->createShippingAddress($user, $total);
                $direction = $_POST['street'] . ', ' . $_POST['city'];
            } else {
                $directionId = $_POST['shipping_address_id'];
                $direction = $this->directionsService->getDirectionById($directionId);
                $direction = $direction['street'] . ', ' . $direction['city'];
            }

            $orderId = $this->orderService->create($user, $directionId, $total);
            $this->orderDetailsService->insertOrderDetails($products, $orderId);

            $this->paypal->tokenControl();
            $draft = $this->paypal->createDraftInvoice($user, $products, $orderId, $direction); 
            if (isset($draft->href)) {
                $msg = 'Compra realizada con éxito';
                unset($_SESSION['cart']);
            } else {
                $msg = 'Ha ocuttido algún problema intentelo de nuevo más tarde.';
            }

            $this->pages->render('sucssesfullPurchase', ['msg' => $msg]);
        }
    }

}