<?php
namespace Controllers;

use Lib\Pages;
use Lib\AuthJWT;
use Services\ProductsService;
use Services\UsersService;
use Utils\DataCleaner;

class AdminProductsController
{
    private ProductsService $productService;
    private Pages $pages;
    private UsersService $service;
    private AuthJWT $authJWT;

    public function __construct()
    {
        $this->productService = new ProductsService();
        $this->service = new UsersService();
        $this->pages = new Pages();
        $this->authJWT = new AuthJWT();
    }

    public function list()
    {
        if ($this->authJWT->accessState()) {
            $user = $this->service->findUserByEmail($_SESSION['email']);
            $products = $this->productService->productsToList();
            $categories = $this->productService->findAllCategories();
            $this->pages->render('admin_products', [
                'user' => $user,
                'products' => $products,
                'categories' => $categories
            ]);
        } else {
            header('Location: /proyecto/');
        }
    }

    public function addProduct()
    {
        if ($this->authJWT->accessState()) {
            $user = $this->service->findUserByEmail($_SESSION['email']);
            $suppliers = $this->productService->findAllSuppliers();
            $categories = $this->productService->findAllCategories();

            $this->pages->render('product', [
                'suppliers' => $suppliers,
                'categories' => $categories,
                'user' => $user
            ]);
        } else {
            header('Location: /proyecto/');
        }
    }

    public function saveProduct()
    {
        if ($this->authJWT->accessState()) {
            ob_start();

            #almaenando datos
            $id = (isset($_POST['id'])) ? (int) $_POST['id'] : null;

            $productCode = DataCleaner::cleanString($_POST['product_code']);
            $name = DataCleaner::cleanString($_POST['name']);
            $price = DataCleaner::cleanString($_POST['price']);
            $description = DataCleaner::cleanString($_POST['description']);
            $stock = DataCleaner::cleanString($_POST['stock']);
            $CategoryId = DataCleaner::cleanString($_POST['category_id']);
            $supplierId = DataCleaner::cleanString($_POST['supplier_id']);
            $isOutstanding = isset($_POST['is_outstanding']) ? DataCleaner::cleanString($_POST['is_outstanding']) : '';

            $photoUrl1 = (isset($_POST['product_photo1'])) ? DataCleaner::cleanString($_POST['product_photo1']) : '';
            $photoUrl2 = (isset($_POST['product_photo2'])) ? DataCleaner::cleanString($_POST['product_photo2']) : '';
            $photoUrl3 = (isset($_POST['product_photo3'])) ? DataCleaner::cleanString($_POST['product_photo3']) : '';
            $photoUrl4 = (isset($_POST['product_photo4'])) ? DataCleaner::cleanString($_POST['product_photo4']) : '';

            $mainPhoto = isset($_POST['is_main']) ? $_POST['is_main'] : '';

            //verificando caampos obligatorios
            if (
                $productCode == '' ||
                $name == '' ||
                $price == '' ||
                $description == '' ||
                $stock == '' ||
                $CategoryId == '' ||
                $supplierId == '' ||
                $isOutstanding == ''
            ) {
                $msg = '
                <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No has rellenado todos los campos obligatorios.
                </div>';
                $user = $this->service->findUserByEmail($_SESSION['email']);
                $suppliers = $this->productService->findAllSuppliers();
                $categories = $this->productService->findAllCategories();

                $this->pages->render('product', [
                    'suppliers' => $suppliers,
                    'categories' => $categories,
                    'user' => $user,
                    'msg' => $msg
                ]);
                exit();
            }

            //verificando integridad de los datos
            if (DataCleaner::dataVerify("[a-zA-Z0-9$@.-]{7,100}", $productCode)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El código del producto no coincide con el formato.
                    </div>';

                    $user = $this->service->findUserByEmail($_SESSION['email']);
                    $suppliers = $this->productService->findAllSuppliers();
                    $categories = $this->productService->findAllCategories();
                    
                    $this->pages->render('product', [
                        'suppliers' => $suppliers,
                        'categories' => $categories,
                        'user' => $user,
                        'msg' => $msg
                    ]);
                exit();
            }

            if (DataCleaner::dataVerify("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $name)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El nombre del producto no coinciden con el formato.
                    </div>';

                    $user = $this->service->findUserByEmail($_SESSION['email']);
                    $suppliers = $this->productService->findAllSuppliers();
                    $categories = $this->productService->findAllCategories();
                    
                    $this->pages->render('product', [
                        'suppliers' => $suppliers,
                        'categories' => $categories,
                        'user' => $user,
                        'msg' => $msg
                    ]);
                exit();
            }

            if (DataCleaner::dataVerify('[0-9.]{8}', $price)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El precio no es valido.
                    </div>';

                    $user = $this->service->findUserByEmail($_SESSION['email']);
                    $suppliers = $this->productService->findAllSuppliers();
                    $categories = $this->productService->findAllCategories();
                    
                    $this->pages->render('product', [
                        'suppliers' => $suppliers,
                        'categories' => $categories,
                        'user' => $user,
                        'msg' => $msg
                    ]);
                exit();
            }

            if (DataCleaner::dataVerify('[0-9]{8}', $stock)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El stock no es valido.
                    </div>';

                    $user = $this->service->findUserByEmail($_SESSION['email']);
                    $suppliers = $this->productService->findAllSuppliers();
                    $categories = $this->productService->findAllCategories();
                    
                    $this->pages->render('product', [
                        'suppliers' => $suppliers,
                        'categories' => $categories,
                        'user' => $user,
                        'msg' => $msg
                    ]);
                exit();
            }
            
            if (DataCleaner::dataVerify('[0-9]{3}', $CategoryId)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        la categoría no es valida.
                    </div>';

                    $user = $this->service->findUserByEmail($_SESSION['email']);
                    $suppliers = $this->productService->findAllSuppliers();
                    $categories = $this->productService->findAllCategories();
                    
                    $this->pages->render('product', [
                        'suppliers' => $suppliers,
                        'categories' => $categories,
                        'user' => $user,
                        'msg' => $msg
                    ]);
                exit();
            }

            if (DataCleaner::dataVerify('[0-9]{3}', $supplierId)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El Suministrador no es valido.
                    </div>';

                    $user = $this->service->findUserByEmail($_SESSION['email']);
                    $suppliers = $this->productService->findAllSuppliers();
                    $categories = $this->productService->findAllCategories();
                    
                    $this->pages->render('product', [
                        'suppliers' => $suppliers,
                        'categories' => $categories,
                        'user' => $user,
                        'msg' => $msg
                    ]);
                exit();
            }

            //Comprobando entradas de la base de datos
            




        } else {
            header('Location: /proyecto/');
        }
    }




}