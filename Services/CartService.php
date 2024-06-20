<?php
namespace Services;

class CartService
{

    public function calculateTotal($products)
    {
        $total = 0;
        foreach ($products as $product) {
            $total += (int) $product['price'];
        }
        return $total;
    }
}