<?php
namespace Controllers;

use Services\RolesService;
use Services\UsersService;
use Lib\Pages;
use Utils\DataCleaner;

class AdminUsersController
{
    private UsersService $service;
    private RolesService $rolesService;
    private Pages $pages;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->rolesService = new RolesService();
        $this->pages = new Pages();
    }

    public function list()
    {
        $users = $this->service->findAll();
        $this->pages->render('admin_users', ['users' => $users]);
    }

    public function add(): void
    {
        $roles = $this->rolesService->getAll();
        $this->pages->render('new_user', ['roles' => $roles]);
    }

    public function SaveUser(): void
    {
        #almaenando datos
        $name = DataCleaner::cleanString($_POST['name']);
        $lastName1 = DataCleaner::cleanString($_POST['last_name1']);
        $lastName2 = DataCleaner::cleanString($_POST['last_name2']);
        $email = DataCleaner::cleanString($_POST['email']);
        $birthDate = DataCleaner::cleanString($_POST['birth_date']);
        $phone = (isset($_POST['phone'])) ? DataCleaner::cleanString($_POST['phone']) : '';
        $dateRegistered = date('Y-m-d-His');
        $photoUrl = (isset($_POST['photo'])) ? DataCleaner::cleanString($_POST['photo']) : '';
        $pass1 = DataCleaner::cleanString($_POST['pass1']);
        $pass2 = DataCleaner::cleanString($_POST['pass2']);
        $cardNumber = (isset($_POST['card_number'])) ? DataCleaner::cleanString($_POST['card_number']) : '';
        $roleId = DataCleaner::cleanString($_POST['role_id']);

        //verificando caampos obligatorios
        if (
            $name == '' ||
            $lastName1 == '' ||
            $lastName2 == '' ||
            $email == '' ||
            $birthDate == '' ||
            $pass1 == '' ||
            $pass2 == '' ||
            $roleId == ''
        ) {
            echo '
            <div class="alert alert-danger fs-3 text-center" role="alert">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has rellenado todos los campos obligatorios.';  
                require_once "./inc/back_button.php"; 
            echo '</div>';
                exit();
            }

        //verificando integridad de los datos
        if (
            (DataCleaner::dataVerify("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $name) || DataCleaner::dataVerify("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $lastName1))
            || ($lastName2 != '' && DataCleaner::dataVerify("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $lastName2))
            ) {
            echo '
                <div class="d-flex justify-content-center flex-column alert alert-danger fs-3 text-center" role="alert">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El nombre o los apellidos no coinciden con el formato.
                ';  
                    require_once "./inc/back_button.php"; 
            echo '</div>';
                exit();
        }

        if (DataCleaner::dataVerify("[a-zA-Z0-9$@.-]{7,100}", $pass1) || DataCleaner::dataVerify("[a-zA-Z0-9$@.-]{7,100}", $pass2)) {
            echo '
                <div class="d-flex justify-content-center flex-column alert alert-danger fs-3 text-center" role="alert">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    La contaseña no coincide con el formato.
                ';  
                    require_once "./inc/back_button.php"; 
            echo '</div>';
                exit();
        }

        if (DataCleaner::validateEmail($email)) {
            $user = $this->service->findUserByEmail($email);
            if (!is_null($user)) {
                echo '
                    <div class="d-flex justify-content-center flex-column alert alert-danger fs-3 text-center" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El email ya existe en la base de datos.';    
                        require_once "./inc/back_button.php"; 
                        echo '</div>';
                exit();
            }
            }
        





            // $user = $_POST['data'];
            // var_dump($_POST);
            // $this->service->save($user);
           // header('Location: /proyecto/admin_users/new_user');
    }
}