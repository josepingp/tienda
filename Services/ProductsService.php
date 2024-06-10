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

    public function findAllSuppliers(): array
    {
        return $this->repo->findAllSuppliers();
    }


    public function findAllCategories(): array
    {
        return $this->repo->findAllCategories();
    }
}
