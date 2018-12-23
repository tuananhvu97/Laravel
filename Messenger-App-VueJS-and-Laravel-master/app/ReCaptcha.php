<?php

namespace App;

use GuzzleHttp\Client;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator){
        $client = new Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6Lfd04IUAAAAANgegtUz6QQIrQXIL0MzY6i0NxHT',
                    'response'=>$value
                 ]
            ]
        );
        $body = json_decode((string)$response->getBody());
        return $body->success;
    }
}
