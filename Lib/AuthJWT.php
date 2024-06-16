<?php
namespace Lib;

use Models\User;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
use Dotenv\Dotenv;

class AuthJWT
{
    private Dotenv $dotenv;

    public function __construct()
    {
        $this->dotenv = Dotenv::createImmutable('./');
    }

    public function createSessionToken(User $user, string $path): array
    {
        $dotenv = Dotenv::createImmutable($path);
        $dotenv->load();

        $secretKey = $_ENV['SIGNATURE_KEY'];

        $iat = time();//fecha creacion
        $exp = $iat + 3600;//fecha expiracion
        $sub = $user->getEmail();
        $payload = [
            "iat" => $iat,
            "exp" => $exp,
            "sub" => $sub,
            "rol" => $user->getRol()
        ];

        //vamos a cifrar / encriptar el payload anterior

        //DEFINO EL METODO DE CIFRADO
        $cipherMethod = "AES-128-CBC";
        //calculo longitud vector inicialización del cifrado
        $iv_long = openssl_cipher_iv_length($cipherMethod);
        //creo el vector de inicialización como un string de bytes random 
        $iv = openssl_random_pseudo_bytes($iv_long);
        //encripto la informacion
        $payload_encriptado = openssl_encrypt(json_encode($payload), $cipherMethod, $_ENV['CIPHER_KEY'], 0, $iv);


        //tenemos el nuevo payload encriptado
        $newPayload = array(
            "data" => $payload_encriptado,
            "iv" => base64_encode($iv)
        );

        //codificamos ese payload en un token JWT
        $jwt = JWT::encode($newPayload, $secretKey, "HS256");

        $jwtArray = [
            "jwt" => $jwt,
            "exp" => $exp
        ];

        return $jwtArray;
    }

    public function JWTdecodeUser($jwt, $secretKey, $cipherKey)
    {
        $this->dotenv->load();

        $cipherMethod = "AES-128-CBC";
        //decodifico el jwt
        $jwtDecode = JWT::decode($jwt, new Key($secretKey, "HS256"));
        //desencripto el payload del jwt
        $payloadDecrypted = openssl_decrypt($jwtDecode->data, $cipherMethod, $cipherKey, 0, base64_decode($jwtDecode->iv));

        //obtengo el valor del usuario que hay en el token
        $pay = json_decode($payloadDecrypted);
        $userJWT = $pay->{'sub'};
        $userRol = $pay->{'rol'};


        return ['user' => $userJWT, 'rol' => $userRol];
    }

    public function accessState()
    {
        ob_start();

        if (
            isset($_COOKIE['JWT']) && 
            isset($_SESSION['email']) &&
            isset($_SESSION['rol'])
            ) {

            $this->dotenv->load();
            
            $userJWT = $this->JWTdecodeUser($_COOKIE['JWT'], $_ENV['SIGNATURE_KEY'], $_ENV['CIPHER_KEY']);
            //compruebo que el mail que tengo en la session es igual que el mail que tengo en el token
            
            if ($_SESSION['email'] == $userJWT['user'] && $_SESSION['rol'] == $userJWT['rol']) {
                http_response_code(200);//OK
                return true;
            }
        } else {
                setcookie("jwt", "", time() - 3600, "/");
                http_response_code(401);//No autorizado.
                return false;
        }
    }

}