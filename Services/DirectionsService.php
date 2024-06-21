<?php
namespace Services;

use Lib\Pages;
use Repositories\DirectionsRepository;


class DirectionsService {
    private DirectionsRepository $repo;
    private Pages $pages;

    public function __construct(){
        $this->repo = new DirectionsRepository();
        $this->pages = new Pages();
    }

    public function getAllByUserId($id) {
        return $this->repo->findDirectionsByUserId($id);
    }

    public function save(array $direction): int
    {
        return $this->repo->save($direction);
    }

    public function getDirectionById($id): array
    {
        return $this->repo->getDirectiponById($id);
    }

    public function createShippingAddress($user, $total)
    {
        if (
            $_POST['street'] == '' ||
            $_POST['shipping-number'] == '' ||
            $_POST['floor'] == '' ||
            $_POST['apartment'] == '' ||
            $_POST['region'] == ''
        ) {
            $msg = 'Debes rellenar todos los datos de la direccion de entrega';
            $this->pages->render(preg_replace('/proyecto/', '', $_SERVER['REQUEST_URI']), ['msg' => $msg, 'total' => $total]);
            exit();
        } else {
            $address = [
                'street' => $_POST['street'],
                'number' => $_POST['shipping-number'],
                'floor' => $_POST['floor'],
                'apartment' => $_POST['apartment'],
                'city' => $_POST['region'],
                'user_id' => $user->getId(),
                'is_main' => isset($_POST['main']) ? 1 : 0
            ];
            return $this->save($address);
        }
    }
}