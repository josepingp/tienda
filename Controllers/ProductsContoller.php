<?php
namespace Controllers;

use Lib\AuthJWT;
use Services\PhotosService;
use Services\ProductsService;
use Services\UsersService;
use Lib\Pages;

class ProductsContoller
{
    private UsersService $service;
    private Pages $pages;
    private AuthJWT $authJWT;
    private PhotosService $photosService;
    private ProductsService $productsService;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->photosService = new PhotosService();
        $this->productsService = new ProductsService();
        $this->pages = new Pages();
        $this->authJWT = new AuthJWT();
    }

    public function load()
    {
        $photos = $this->photosService->findAllPhotos();
        $products = $this->productsService->findAllProducts();
        $productsToFront = [];

        foreach ($products as $product) {
            $item = [];
            $itemPhotos = [];
            $mainPhoto = '';
            foreach ($photos as $key => $photo) {
                if ($photo['product_id'] == $product['id'] && $photo['is_main'] == 0) {
                    array_push($itemPhotos, $photo['url']);
                } elseif ($photo['product_id'] == $product['id']) {
                    $mainPhoto = $photo['url'];
                }
            }

            $item[] = ['id' => $product['id'], 'name' => $product['name'], 'price' => $product['price'], 'main_photo' => $mainPhoto, 'photos' => $itemPhotos];
            $productsToFront[] = $item;
        }

        if ($this->authJWT->accessState()) {
            $user = $this->service->findUserByEmail($_SESSION['email']);
            $this->pages->render('products', [
                'products' => $productsToFront,
                'user' => $user
            ]);
        } else {
            $this->pages->render('products', [
                'products' => $productsToFront
            ]);
        }
    }

    public function listCategory($category)
    {
            $categories = [
                '1' => 'MODA',
                '2' => 'ZAFUS',
                '3' => 'ESTERILLAS',
                '4' => 'MANTAS',
                '5' => 'ACCESORIOS',
                '6' => 'MEDITACION',
            ];

            
            $photos = $this->photosService->findAllPhotos();
            $products = $this->productsService->findAllProductsByCategory($category);
            $productsToFront = [];
    
            foreach ($products as $product) {
                $item = [];
                $itemPhotos = [];
                $mainPhoto = '';
                foreach ($photos as $key => $photo) {
                    if ($photo['product_id'] == $product['id'] && $photo['is_main'] == 0) {
                        array_push($itemPhotos, $photo['url']);
                    } elseif ($photo['product_id'] == $product['id']) {
                        $mainPhoto = $photo['url'];
                    }
                }
    
                $item[] = ['id' => $product['id'], 'name' => $product['name'], 'price' => $product['price'], 'main_photo' => $mainPhoto, 'photos' => $itemPhotos];
                $productsToFront[] = $item;
            }
            
            $category = $categories[$category];

            if ($this->authJWT->accessState()) {
                $user = $this->service->findUserByEmail($_SESSION['email']);
                $this->pages->render('products', [
                    'products' => $productsToFront,
                    'category' => $category,
                    'user' => $user
                ]);
            } else {
                $this->pages->render('products', [
                    'category' => $category,
                    'products' => $productsToFront
                ]);
            }
        }

        public function detail($id)
        {
            $product = $this->productsService->findProductById($id);
            $photos = $this->photosService->findAllPhotosByProductId($id);
            
            if ($this->authJWT->accessState()) {
                $user = $this->service->findUserByEmail($_SESSION['email']);
                $this->pages->render('productDetail', [
                    'user' => $user,
                    'product' => $product,
                    'photos' => $photos
                ]);
            } else {
                $this->pages->render('productDetail', [
                    'product' => $product,
                    'photos' => $photos
                ]);
            }
        }

        public function addProductToCart() 
        {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            } 
            array_push($_SESSION['cart'], $_POST['product_id']);
        }
    
}