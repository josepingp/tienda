<?php
namespace Controllers;

use Lib\AuthJWT;
use Services\UsersService;
use Lib\Pages;
use Utils\DataCleaner;


class HomeController
{
    private UsersService $service;
    private Pages $pages;
    private AuthJWT $authJWT;

    public function __construct()
    {
        $this->service = new UsersService();
        $this->pages = new Pages();
        $this->authJWT = new AuthJWT();
    }


    public function load()
    {
        if ($this->authJWT->accessState()) {

            $user = $this->service->findUserByEmail($_SESSION['email']);
            $this->pages->render('home', ['user' => $user]);

        } else {
            $this->pages->render('home');

        }
    }

    public function log()
    {
        if (isset($_POST['session_close'])) {
            setcookie("JWT", "", time() - 3600, "/");
            setcookie("PHPSESSID", "", time() - 3600, "/");
            header('Location: /proyecto');
        } else {
            $pass = DataCleaner::cleanString($_POST['pass']);
            $email = DataCleaner::cleanString($_POST['email']);
            if ($this->service->userVerify($email, $pass)) {
                ob_start();

                $user = $this->service->findUserByEmail($email);

                $_SESSION['name'] = $user->getName();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['rol'] = $user->getRol();

                //creo el JWT token
                $jwt = $this->authJWT->createSessionToken($user, './');
                //Lo meto en una cookie solo http
                //El identificador del usuario es el mail que esta en el sub del payload
                //El rol del usuario esta en el payload['rol']
                setcookie('JWT', $jwt['jwt'], $jwt['exp'], '/', '', true);
                $this->pages->render('home', ['user' => $user]);
            } else {
                $msg = '
                <div>
                <strong>¡Ocurrio un error!</strong><br>
                El Usuario o la contraseña no son correctos.
                </div>';
                $this->pages->render('home', ['msg' => $msg]);
            }
        }
    }

    public function loadReg()
    {

        if ($this->authJWT->accessState()) {

            $user = $this->service->findUserByEmail($_SESSION['email']);
            $this->pages->render('register', ['user' => $user]);

        } else {
            $this->pages->render('register');

        }
        
    }

    public function addReg()
    {

            ob_start();

            #almaenando datos
            $name = DataCleaner::cleanString($_POST['name']);
            $lastName1 = DataCleaner::cleanString($_POST['last_name1']);
            $lastName2 = DataCleaner::cleanString($_POST['last_name2']);
            $email = DataCleaner::cleanString($_POST['email']);
            $birthDate = DataCleaner::cleanString($_POST['birthdate']);
            $dateRegistered = date('Y-m-d_H_i_s');
            $pass1 = DataCleaner::cleanString($_POST['pass1']);
            $pass2 = DataCleaner::cleanString($_POST['pass2']);
            $roleId = (isset($_POST['role_id'])) ? DataCleaner::cleanString($_POST['role_id']) : 2;


            //verificando caampos obligatorios
            if (
                $name == '' ||
                $lastName1 == '' ||
                $lastName2 == '' ||
                $email == '' ||
                $birthDate == '' ||
                $pass1 == '' ||
                $pass2 == ''
            ) {
                $msg = '
                <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No has rellenado todos los campos obligatorios.
                </div>';

                $this->pages->render('register', ['msg' => $msg]);
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

                $this->pages->render('register', ['msg' => $msg]);
                exit();
            }

            if (DataCleaner::dataVerify("[a-zA-Z0-9$@.-]{7,100}", $pass1) || DataCleaner::dataVerify("[a-zA-Z0-9$@.-]{7,100}", $pass2)) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La contaseña no coincide con el formato.
                    </div>';

                $this->pages->render('register', ['msg' => $msg]);
                exit();
            }

            if (DataCleaner::validateEmail($email)) {
                $user = $this->service->findUserByEmail($email);
                if (!is_null($user)) {
                    $msg = '
                        <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                            <strong>¡Ocurrio un error inesperado!</strong><br>
                            El email ya existe en la base de datos.
                        </div>';

                    $this->pages->render('register', ['msg' => $msg]);
                    exit();
                }

            } else {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El email no es valido.
                    </div>';

                $this->pages->render('register', ['msg' => $msg]);
                exit();
            }

            if ($pass1 != $pass2) {
                $msg = '
                    <div <div class="alert alert-danger fs-4 text-center mx-5 w-50" role="alert">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Las contraseñas no coinciden.
                    </div>';

                ;
                $this->pages->render('register', ['msg' => $msg]);
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

                        $this->pages->render('register', ['msg' => $msg]);
                        exit();
                    }
                }

                //Le damos permisos de lectura y escritura al directorio
                chmod($imgDir, 0777);

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

                    $this->pages->render('register', ['msg' => $msg]);
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

                    $this->pages->render('register', ['msg' => $msg]);
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
                $imgName = DataCleaner::cleanPhotoName($imgName);

                chmod($imgDir, 0777);
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $imgDir . $imgName)) {
                    $msg = '
                        <div class="alert alert-danger fs-4 text-center mx-5 w-50">
                            <strong>¡Ocurrio un error inesperado!</strong><br>
                            La imagen no se pudo cargar correctamente.    
                        </div> 
                        ';

                    $this->pages->render('register', ['msg' => $msg]);
                    exit();
                }
            }

            $user = [
                'name' => $name,
                'last_name1' => $lastName1,
                'last_name2' => $lastName2,
                'email' => $email,
                'birth_date' => $birthDate,
                'date_registered' => $dateRegistered,
                'photo_url' => isset($imgName) ? $imgName : '',
                'password' => $password,
                'role_id' => $roleId
            ];

            $msg = '
                <div class="d-flex justify-content-center flex-column alert alert-succsess fs-5 text-center caquita" role="alert">
                    <strong>¡Usuario registrado con éxito!</strong><br>
                </div>
                ';
                
                $this->service->save($user);

                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['rol'] = $roleId;

                $user = $this->service->findUserByEmail($email);
                $jwt = $this->authJWT->createSessionToken($user, './');
                setcookie('JWT', $jwt['jwt'], $jwt['exp'], '/', '', true);

                header('Location: /proyecto');
        }
    }



