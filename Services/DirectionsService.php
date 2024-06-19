<?php
namespace Services;

use Repositories\DirectionsRepository;

class DirectionsService {
    private DirectionsRepository $repo;

    public function __construct(){
        $this->repo = new DirectionsRepository();
    }

    public function getAllByUserId($id) {
        return $this->repo->findDirectionsByUserId($id);
    }

    public function save(array $direction): void
    {
        $this->repo->save($direction);
    }
}