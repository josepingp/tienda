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

    public function findAllCategories(): array
    {
        $this->conexion->query("SELECT id, category_name FROM categories");
        return $this->conexion->getAll();
    }

    public function findAllSuppliers(): array
    {
        $this->conexion->query("SELECT id, supplier_name FROM suppliers");
        return $this->conexion->getAll();
    }


    public function findAllProductsToList(): array
    {
        $this->conexion->query("SELECT 
        products.id,
        photos.url,
        products.product_code,
        products.name, 
        products.price, 
        products.stock,
        categories.category_name,
        suppliers.supplier_name,
        products.is_outstanding
        FROM products LEFT JOIN photos
        ON products.id = photos.product_id AND
        photos.is_main = true
        INNER JOIN suppliers ON
        suppliers.id = products.supplier_id
        INNER JOIN categories ON
        categories.id = products.category_id");

        return $this->conexion->getAll();
    }

    public function searchProductToList(string $search): array
    {
        $this->conexion->query("SELECT
        products.id, 
        products.product_code,
        products.name, 
        products.price, 
        products.stock,
        products.is_outstanding,
        categories.category_name,
        suppliers.supplier_name,
        photos.url
        FROM products LEFT JOIN photos
        ON products.id = photos.product_id AND
        photos.is_main = true
        INNER JOIN suppliers ON
        suppliers.id = products.supplier_id
        INNER JOIN categories ON
        categories.id = products.category_id
        WHERE products.product_code LIKE '%$search%'
        OR products.name LIKE '%$search%'
        ");

        return $this->conexion->getAll();
    }
}