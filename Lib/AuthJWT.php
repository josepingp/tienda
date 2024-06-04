<?php
namespace Lib;

use Models\User;
use Services\UsersService;
use Lib\Pages;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
use Dotenv\Dotenv;
use Utils\DataCleaner;

class AuthJWT
{
    public function createSessionToken(User $user, string $path)
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

    public function setCoki()
    {
        setcookie('cokie', 'hola, time()+3600');
    }


}