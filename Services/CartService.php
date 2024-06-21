<?php
namespace Services;

use Services\ProductsService;

class CartService
{
    private ProductsService $productsService;

    public function __construct()
    {
        $this->productsService = new ProductsService();
    }

    public function calculateTotal(array $products): mixed
    {
        $total = 0;
        foreach ($products as $product) {
            $total += (int) $product['price'] * $product['quantity'];
        }
        return $total;
    }

    public function countProducts(): array
    {
        $products = $this->productsService->findProductsByIds($_SESSION['cart']);

        for ($i = 0; $i < count($products); $i++) {
            $products[$i]['quantity'] = 0;
            foreach ($_SESSION['cart'] as $productId) {
                if ($productId == $products[$i]['id']) {
                    $products[$i]['quantity']++;
                }
            }
        }
        return $products;
    }

}