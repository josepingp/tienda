<?php
namespace Repositories;

use Lib\Db;
use Models\Photo;

class PhotosRepository
{
    private Db $conexion;

    public function __construct()
    {
        $this->conexion = new Db();
    }

    public function findAllPhotosByProductId(int $productId): ?array
    {
        $this->conexion->query("SELECT * FROM photos WHERE product_id= $productId");
        return $this->conexion->getAll();
    }

    public function findAllPhotos(): array
    {
        $this->conexion->query("SELECT * FROM photos");
        return $this->conexion->getAll();
    }

}