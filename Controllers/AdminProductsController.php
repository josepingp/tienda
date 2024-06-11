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
            $isOutstanding = isset($_POST['is_outstanding']) ? 1 : 0;

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
                $supplierId == '' 
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
            if (DataCleaner::dataVerify("[a-zA-Z0-9$@.-]{4,100}", $productCode)) {
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

            if (DataCleaner::dataVerify('[0-9.]{1,8}', $price)) {
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

            if (DataCleaner::dataVerify('[0-9]{1,8}', $stock)) {
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

            if (DataCleaner::dataVerify('[0-9]{1,3}', $CategoryId)) {
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

            if (DataCleaner::dataVerify('[0-9]{1,3}', $supplierId)) {
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
            $product = $this->productService->findProductByName($name);
            if (!is_null($product)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El Nombre del producto ya existe en la base de datos.
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

            $product = $this->productService->findProductByCode($productCode);
            if (!is_null($product)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El Código del producto ya existe en la base de datos.
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

            $product = [
                'product_code' => $productCode,
                'name' => $name,
                'price' => $price,
                'stock' => $stock,
                'category_id' => $CategoryId,
                'supplier_id' => $supplierId,
                'description' => $description,
                'is_outstanding' => $isOutstanding
            ];

            $this->productService->save($product);
            

            //Imagenes
            $imgDir = "./repo/product/";

            if (
                (isset($_FILES['product_photo1']) && $_FILES['product_photo1']['error'] == 0) ||
                (isset($_FILES['product_photo2']) && $_FILES['product_photo2']['error'] == 0) ||
                (isset($_FILES['product_photo3']) && $_FILES['product_photo3']['error'] == 0) ||
                (isset($_FILES['product_photo4']) && $_FILES['product_photo4']['error'] == 0)
            ) {
                if (!file_exists($imgDir)) {
                    if (!mkdir($imgDir)) {
                        $msg = '
                            <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                                <strong>¡Ocurrio un error inesperado!</strong><br>
                                Error al crear el directorio.    
                            </div>
                        ';

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
                }

                //Le damos permisos de lectura y escritura al directorio
                chmod($imgDir, 0777);

                //Verificando formato de imágenes
                if (
                    $_FILES['product_photo1']['error'] == 0 &&
                    mime_content_type($_FILES['product_photo1']['tmp_name']) != "image/jpeg" &&
                    mime_content_type($_FILES['product_photo1']['tmp_name']) != "image/png"
                ) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 1 tiene un formato erroneo.    
                    </div>
                    ';

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

                if (
                    $_FILES['product_photo2']['error'] == 0 &&
                    mime_content_type($_FILES['product_photo2']['tmp_name']) != "image/jpeg" &&
                    mime_content_type($_FILES['product_photo2']['tmp_name']) != "image/png"
                ) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 2 tiene un formato erroneo.    
                    </div>
                    ';

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

                if (
                    $_FILES['product_photo3']['error'] == 0 &&
                    mime_content_type($_FILES['product_photo3']['tmp_name']) != "image/jpeg" &&
                    mime_content_type($_FILES['product_photo3']['tmp_name']) != "image/png"
                ) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 3 tiene un formato erroneo.    
                    </div>
                    ';

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

                if (
                    $_FILES['product_photo4']['error'] == 0 &&
                    mime_content_type($_FILES['product_photo4']['tmp_name']) != "image/jpeg" &&
                    mime_content_type($_FILES['product_photo4']['tmp_name']) != "image/png"
                ) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 4 tiene un formato erroneo.    
                    </div>
                    ';

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

                //Verificando peso de la imagen
                if ($_FILES['product_photo1']['error'] == 0 && $_FILES['product_photo1']['size'] / 1024 > 3072) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 1 supera el peso permitido.    
                    </div>
                    ';

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

                if ($_FILES['product_photo2']['error'] == 0 && $_FILES['product_photo2']['size'] / 1024 > 3072) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 2 supera el peso permitido.    
                    </div>
                    ';

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

                if ($_FILES['product_photo3']['error'] == 0 && $_FILES['product_photo3']['size'] / 1024 > 3072) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 3 supera el peso permitido.    
                    </div>
                    ';

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

                if ($_FILES['product_photo4']['error'] == 0 && $_FILES['product_photo4']['size'] / 1024 > 3072) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 4 supera el peso permitido.    
                    </div>
                    ';

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

                //Extension de la imagen
                if ($_FILES['product_photo1']['error'] == 0) {
                    switch (mime_content_type($_FILES['product_photo1']['tmp_name'])) {
                        case "image/jpeg":
                            $imgExtension = ".jpeg";
                            break;
                        case "image/png":
                            $imgExtension = ".png";
                            break;
                    }

                    $imgName1 = $productCode . '1_' . date('Y.m.d_His') . $imgExtension;
                    $imgName1 = DataCleaner::cleanPhotoName($imgName1);
                }

                if ($_FILES['product_photo2']['error'] == 0) {
                    switch (mime_content_type($_FILES['product_photo2']['tmp_name'])) {
                        case "image/jpeg":
                            $imgExtension = ".jpeg";
                            break;
                        case "image/png":
                            $imgExtension = ".png";
                            break;
                    }

                    $imgName2 = $productCode . '2_' . date('Y.m.d_His') . $imgExtension;
                    $imgName2 = DataCleaner::cleanPhotoName($imgName2);
                }

                if ($_FILES['product_photo3']['error'] == 0) {
                    switch (mime_content_type($_FILES['product_photo3']['tmp_name'])) {
                        case "image/jpeg":
                            $imgExtension = ".jpeg";
                            break;
                        case "image/png":
                            $imgExtension = ".png";
                            break;
                    }

                    $imgName3 = $productCode . '3_' . date('Y.m.d_His') . $imgExtension;
                    $imgName3 = DataCleaner::cleanPhotoName($imgName3);
                }

                if ($_FILES['product_photo4']['error'] == 0) {
                    switch (mime_content_type($_FILES['product_photo4']['tmp_name'])) {
                        case "image/jpeg":
                            $imgExtension = ".jpeg";
                            break;
                        case "image/png":
                            $imgExtension = ".png";
                            break;
                    }

                    $imgName4 = $productCode . '4_' . date('Y.m.d_His') . $imgExtension;
                    $imgName4 = DataCleaner::cleanPhotoName($imgName4);
                }

                chmod($imgDir, 0777);
                if ($_FILES['product_photo1']['error'] == 0 && !move_uploaded_file($_FILES['product_photo1']['tmp_name'], $imgDir . $imgName1)) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 1 no se pudo cargar correctamente.    
                    </div> 
                    ';

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

                if ($_FILES['product_photo2']['error'] == 0 && !move_uploaded_file($_FILES['product_photo2']['tmp_name'], $imgDir . $imgName2)) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 2 no se pudo cargar correctamente.    
                    </div> 
                    ';

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

                if ($_FILES['product_photo3']['error'] == 0 && !move_uploaded_file($_FILES['product_photo3']['tmp_name'], $imgDir . $imgName3)) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 3 no se pudo cargar correctamente.    
                    </div> 
                    ';

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

                if ($_FILES['product_photo4']['error'] == 0 && !move_uploaded_file($_FILES['product_photo4']['tmp_name'], $imgDir . $imgName4)) {
                    $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen número 4 no se pudo cargar correctamente.    
                    </div> 
                    ';

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
                $productId = $this->productService->findProductByName($name);
                $productId = $productId['id'];
    
                $photoArray = [];
                
                if (isset($imgName1)) {
                    $photoArray[] = [
                        'url' => $imgName1,
                        'is_main' => ($mainPhoto == "product_photo1") ? 1 : 0,
                        'product_id' => $productId
                    ];
                }

                if (isset($imgName2)) {
                    $photoArray[] = [
                        'url' => $imgName2,
                        'is_main' => ($mainPhoto == "product_photo2") ? 1 : 0,
                        'product_id' => $productId
                    ];
                }

                if (isset($imgName3)) {
                    $photoArray[] = [
                        'url' => $imgName3,
                        'is_main' => ($mainPhoto == "product_photo3") ? 1 : 0,
                        'product_id' => $productId
                    ];
                }

                if (isset($imgName4)) {
                    $photoArray[] = [
                        'url' => $imgName4,
                        'is_main' => ($mainPhoto == "product_photo4") ? 1 : 0,
                        'product_id' => $productId
                    ];
                }

                $msg = $photoArray;
                $this->productService->savePhotos($photoArray);
            }






            
            $user = $this->service->findUserByEmail($_SESSION['email']);
                        $suppliers = $this->productService->findAllSuppliers();
                        $categories = $this->productService->findAllCategories();

                        $this->pages->render('product', [
                            'suppliers' => $suppliers,
                            'categories' => $categories,
                            'user' => $user,
                            'msg' => $msg
                        ]);


            // header('Location: /proyecto/admin_products/');


        } else {
            header('Location: /proyecto/');
        }
    }




}