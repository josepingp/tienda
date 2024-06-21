<?php

namespace Lib;

use DateTime;
use Dotenv\Dotenv;
use Models\User;



class Paypal
{

    private Dotenv $dotenv;

    public function __construct()
    {
        $this->dotenv = Dotenv::createImmutable('./');
    }

    private function generateToken()
    {

        $client_Id = 'AYJSH3mXDZAN4RY0-q9SqySFUjkg9ls2jC954ogpg6fG77RAMUP2rVpeE-ZJ4RpoRBr50XMgG8ooA2Cw';
        $secret = 'EC1kTpL--R27Z7dF1Jphe6qXwp6RvDQ5LShTmiw5d9b0DRrgHnDySASkWfwQXhs511SS_I7lTimdlTWW';

        $credentials = $client_Id . ":" . $secret;
        $encodeCredentials = base64_encode($credentials);

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token?=null',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: basic ' . $encodeCredentials
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        $_SESSION['paypal_token'] = json_decode($response)->{'access_token'};
    }

    public function tokenControl()
    {
        ob_start();

        if (!isset($_SESSION['paypal_token'])) {
            
            $this->generateToken();
            
        }
    }

    public function tokenDecode()
    {
        $this->dotenv->load();

        $cipherMethod = "AES-128-CBC";
        $tokenDecrypted = openssl_decrypt($_COOKIE['Paypal'], $cipherMethod, $_ENV['CIPHER_KEY'], 0, base64_decode($_COOKIE['Paypal']->iv));

        return json_decode($tokenDecrypted);
    }

    public function createDraftInvoice(User $user, array $products, int $orderId, string $direction)
    {
        $curl = curl_init();

        $fecha = (new DateTime())->format('Y-m-d');

        $items = '';
        for ($i = 0; $i < count($products); $i++) {
            if ($i < count($products) - 1) {
                $items .= '{
                    "name": "'.$products[$i]['name'].'",
                    "description": "'.$products[$i]['name'].'",
                    "quantity": "'.$products[$i]['quantity'].'",
                    "unit_amount": {
                        "currency_code": "EUR",
                        "value": "'.$products[$i]['price'] .'"
                        },
                        "unit_of_measure": "QUANTITY"
                        },';
            } else {
                $items .= '{
                    "name": "'.$products[$i]['name'].'",
                    "description": "'.$products[$i]['name'].'",
                    "quantity": "'.$products[$i]['quantity'].'",
                    "unit_amount": {
                        "currency_code": "EUR",
                        "value": "'.$products[$i]['price'] .'"
                        },
                        "unit_of_measure": "QUANTITY"
                        }';
            }
        }
            
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/invoicing/invoices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "detail": {
                 "currency_code": "EUR",
                "invoice_number": "' . $orderId . '",
                "reference": "deal-ref",
                "invoice_date": "' . $fecha . '",
                 "note": "Gracias por su pedido."
               },
               "invoicer": {
                 "name": {
                   "given_name": "Restaurante Family"
                 },
                 "address": {
                   "address_line_1": "Calle Mayor 10"
                 },
                 "email_address": "contacto@restaurantefamily.com"
               },
              "primary_recipients": [
                {
                  "billing_info": {
                    "name": {
                      "given_name": "' . $user->getFullName() . '"
                    },
                    "address": {
                      "address_line_1": "' . $direction . '"
                    },
                    "email_address": "' . $user->getEmail() . '",
                    "additional_info_value": "add-info"
                  }
                }
              ],
              "items": [' . $items . '
              ]
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['paypal_token']
            ),
        )
        );

        //aqui ejecuto la petición htttp
        $response = curl_exec($curl);

        //aqui formateo la respuesta a un string de json
        $response = json_decode($response);

        curl_close($curl);
        return $response;

    }

}


// $api = new Paypal();
// echo $api->generateToken();


