<?php
namespace Services;

use Repositories\PhotosRepository;

class PhotosService
{
    private PhotosRepository $repo;

    public function __construct()
    {
        $this->repo = new PhotosRepository();
    }

    public function findAllPhotosByProductId(int $productId): ?array
    {
        return $this->repo->findAllPhotosByProductId($productId);
    }
    
    public function findAllPhotos(): array
    {
        return $this->repo->findAllPhotos();
    }
}