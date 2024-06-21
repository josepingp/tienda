<?php
namespace Services;

use Models\Product;
use Models\Supplier;
use Models\Photo;
use Repositories\ProductsRepository;

class ProductsService
{
    private ProductsRepository $repo;

    public function __construct()
    {
        $this->repo = new ProductsRepository();
    }

    public function productsToList()
    {
        return $this->repo->findAllProductsToList();
    }

    public function searchProductToList(string $search): array
    {
        return $this->repo->searchProductToList($search);
    }

    public function findFeaturedProducts(): array
    {
        return $this->repo->findAllFeaturedProducts();
    }

    public function findAllSuppliers(): array
    {
        return $this->repo->findAllSuppliers();
    }

    public function findAllCategories(): array
    {
        return $this->repo->findAllCategories();
    }

    public function findProductByName(string $name): ?array
    {
        return $this->repo->findProductByName($name);
    }

    public function findAllProducts(): array 
    {
        return $this->repo->findAllProducts();
    }
    
    public function findProductByCode(string $code): ?array
    {
        return $this->repo->findProductByCode($code);
    }

    public function save(array $product) :void
    {
        $this->repo->saveProduct($product);
    }

    public function savePhotos(array $photos) :void
    {
        $this->repo->savePhotos($photos);
    }

    public function findAllProductsByCategory(int $categoryId): ?array
    {
        return $this->repo->findAllProductsByCategory($categoryId);
    }

    public function findProductsByIds($ids): ?array
    {
        return $this->repo->findProductsByIds($ids);
    }

    public function findProductById($id)
    {
        return $this->repo->findProductById($id);
    }
}