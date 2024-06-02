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
        ob_start();

        #almaenando datos
        $id = (isset($_POST['id'])) ? (int) $_POST['id'] : null;

        $name = DataCleaner::cleanString($_POST['name']);
        $lastName1 = DataCleaner::cleanString($_POST['last_name1']);
        $lastName2 = DataCleaner::cleanString($_POST['last_name2']);
        $email = DataCleaner::cleanString($_POST['email']);
        $birthDate = DataCleaner::cleanString($_POST['birth_date']);
        $phone = (isset($_POST['phone'])) ? DataCleaner::cleanString($_POST['phone']) : '';
        $dateRegistered = date('Y-m-d_H_i_s');
        $photoUrl = (isset($_POST['photo'])) ? DataCleaner::cleanString($_POST['photo']) : '';
        $pass1 = DataCleaner::cleanString($_POST['pass1']);
        $pass2 = DataCleaner::cleanString($_POST['pass2']);
        $cardNumber = (isset($_POST['card_number'])) ? DataCleaner::cleanString($_POST['card_number']) : '';
        $roleId = (isset($_POST['role_id'])) ? DataCleaner::cleanString($_POST['role_id']) : 2;

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
            $msg = '
                <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No has rellenado todos los campos obligatorios.
                </div>';

            $roles = $this->rolesService->getAll();
            $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
            $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
            exit();
        }

        //verificando integridad de los datos
        if (
            (DataCleaner::dataVerify("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $name) || DataCleaner::dataVerify("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $lastName1))
            || ($lastName2 != '' && DataCleaner::dataVerify("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $lastName2))
        ) {
            $msg = '
                <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El nombre o los apellidos no coinciden con el formato.
                </div>';

            $roles = $this->rolesService->getAll();
            $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
            $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
            exit();
        }

        if (DataCleaner::dataVerify("[a-zA-Z0-9$@.-]{7,100}", $pass1) || DataCleaner::dataVerify("[a-zA-Z0-9$@.-]{7,100}", $pass2)) {
            $msg = '
                <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    La contaseña no coincide con el formato.
                </div>';

            $roles = $this->rolesService->getAll();
            $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
            $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
            exit();
        }

        if ($cardNumber != '') {
            if (DataCleaner::dataVerify('^5[1-5][0-9]{14}$', $cardNumber)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El email ya existe en la base de datos.
                    </div>';

                $roles = $this->rolesService->getAll();
                $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
                $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
                exit();
            }
        }

        if ($phone != '') {
            if (DataCleaner::dataVerify('(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}', $phone)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El teléfono no es valido.
                    </div>';

                $roles = $this->rolesService->getAll();
                $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
                $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
                exit();
            }
        }

        if (DataCleaner::validateEmail($email)) {
            $user = $this->service->findUserByEmail($email);
            if (!is_null($user) && $email != $user->getEmail()) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El email ya existe en la base de datos.
                    </div>';

                $roles = $this->rolesService->getAll();
                $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
                $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
                exit();
            }

        } else {
            $msg = '
                <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El email no es valido.
                </div>';

            $roles = $this->rolesService->getAll();
            $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
            $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
            exit();
        }

        if ($pass1 != $pass2) {
            $msg = '
                <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    Las contraseñas no coinciden.
                </div>';

            $roles = $this->rolesService->getAll();
            $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
            $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
            exit();

        } else {
            $password = password_hash($pass1, PASSWORD_BCRYPT, ["cost" => 10]);
        }

        //Aqui tengo que hacer el codigo de las fotos

        $imgDir = "./repo/user/";

        //comprobar si se cargo una imagen
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

            //Verificando el directotio y si no lo creamos
            if (!file_exists($imgDir)) {
                if (!mkdir($imgDir)) {
                    $msg = '
                        <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                            <strong>¡Ocurrio un error inesperado!</strong><br>
                            Error al crear el directorio.    
                        </div>
                    ';

                    $roles = $this->rolesService->getAll();
                    $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
                    $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
                    exit();
                }
            }

            //Le damos permisos de lectura y escritura al directorio
            // chmod($imgDir, 0777);

            //Verificando formato de imágenes
            if (
                mime_content_type($_FILES['photo']['tmp_name']) != "image/jpeg" &&
                mime_content_type($_FILES['photo']['tmp_name']) != "image/png"
            ) {
                $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen tiene un formato erroneo.    
                    </div>
                    ';

                $roles = $this->rolesService->getAll();
                $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
                $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
                exit();
            }

            //Verificando peso de la imagen
            if ($_FILES['photo']['size'] / 1024 > 3072) {
                $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen supera el peso permitido.    
                    </div>
                    ';

                $roles = $this->rolesService->getAll();
                $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
                $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
                exit();
            }

            //Extension de la imagen
            switch (mime_content_type($_FILES['photo']['tmp_name'])) {
                case "image/jpeg":
                    $imgExtension = ".jpeg";
                    break;
                case "image/png":
                    $imgExtension = ".png";
                    break;
            }

            $imgName = $name . $lastName1 . $lastName2 . '_' . date('Y.m.d_His') . $imgExtension;
            $imgName = DataCleaner::limpiarCadena($imgName);

            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $imgDir . $imgName)) {
                $msg = '
                    <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen no se pudo cargar correctamente.    
                    </div> 
                    ';

                $roles = $this->rolesService->getAll();
                $user = (!is_null($id)) ? $this->service->findUserById($id) : null;
                $this->pages->render('new_user', ['msg' => $msg, 'roles' => $roles, 'user' => $user]);
                exit();
            }

            if (is_file($imgDir . $photoUrl) && $photoUrl != $imgName) {
                chmod($imgDir . $photoUrl, 0777);
                unlink($imgDir . $photoUrl);
            }
        }

        $user = [
            'id' => $id,
            'name' => $name,
            'last_name1' => $lastName1,
            'last_name2' => $lastName2,
            'email' => $email,
            'birth_date' => $birthDate,
            'phone' => $phone,
            'date_registered' => $dateRegistered,
            'photo_url' => $photoUrl,
            'password' => $password,
            'card_number' => $cardNumber,
            'role_id' => $roleId
        ];

        if (is_null($user['id']))
            $user = array_shift($user);
        if (isset($imgName))
            $user['photo_url'] = $imgName;



        $this->service->save($user);

        header('location: /proyecto/admin_users');

        $msg = '
                <div class="d-flex justify-content-center flex-column alert alert-succsess fs-5 text-center caquita" role="alert">
                    <strong>¡Usuario registrado con éxito!</strong><br>
                </div>
                ';

        $this->pages->render('new_user', ['msg' => $msg]);
    }


    public function editUser($id): void
    {
        $roles = $this->rolesService->getAll();
        $user = $this->service->findUserById($id);
        $this->pages->render('new_user', ['user' => $user, 'roles' => $roles]);
    }
}
