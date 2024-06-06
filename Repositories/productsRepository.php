<?php
namespace Repositories;

use Lib\Db;
use Models\Product;

class ProductsRepository
{
    private Db $conexion;

    public function __construct()
    {
        $this->conexion = new Db();
    }

    public function findProductById($id): Product
    {
        $this->conexion->query("SELECT * FROM products WHERE id = $id");
        return $this->get();
    }

    public function get(): ?Product
    {
        return ($product = $this->conexion->get()) ? Product::fromArray($product) : null;
    }

    public function findAllFeaturedProducts()
    {
        $this->conexion->query(
                            "SELECT products.id, products.name, products.price, photos.url 
                            FROM products LEFT JOIN photos
                            ON products.id = photos.product_id 
                            WHERE photos.is_main = true
                            AND products.is_outstanding = true"
                            );
        return $this->conexion->getAll();
    }
}