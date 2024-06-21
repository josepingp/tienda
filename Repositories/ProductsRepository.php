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

    public function findProductById($id): ?array
    {
        $this->conexion->query("SELECT * FROM products WHERE id = $id");
        return $this->conexion->get();
    }

    public function get(): ?Product
    {
        return ($product = $this->conexion->get()) ? Product::fromArray($product) : null;
    }

    public function findAllProducts(): array
    {
        $this->conexion->query("SELECT * FROM products");
        return $this->conexion->getAll();
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

    public function findProductByName(string $name): ?array
    {
        $this->conexion->query("SELECT * FROM products WHERE products.name = '" . $name . "'");
        return $this->conexion->get();
    }

    public function findProductByCode(string $code): ?array
    {
        $this->conexion->query("SELECT * FROM products WHERE product_code = '" . $code . "'");
        return $this->conexion->get();
    }

    public function saveProduct(array $product): void
    {
        $this->create($product);
    }

    private function create(array $product): void
    {
        $fields = implode(",", array_keys($product));
        $values = implode("', '", array_values($product));

        $this->conexion->query("INSERT INTO products ($fields) VALUES ('$values')");
    }

    public function savePhotos(array $photos): void
    {
        $fields = implode(", ", array_keys($photos[0]));
        $photoValues = [];

        foreach ($photos as $value) {
            $photoValues[] = "('" . implode("', '", array_values($value)) . "')";
        }

        $values = implode(", ", $photoValues);
        $this->conexion->query("INSERT INTO photos ($fields) VALUES $values");
    }

    public function findAllProductsByCategory(int $categoryId): ?array
    {
        $this->conexion->query("SELECT products.id, products.name, products.price FROM products WHERE category_id = $categoryId");
        return $this->conexion->getAll();
    }

    public function findProductsByIds($ids): ?array
    {
        $placeholders = implode(', ', array_fill(0, count($ids), '?'));
        $stmt = $this->conexion->prepare("SELECT id, name, description, product_code, price FROM products WHERE id IN ($placeholders)");

        $types = str_repeat('i', count($ids));
        $stmt->bind_param($types, ...$ids);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}



