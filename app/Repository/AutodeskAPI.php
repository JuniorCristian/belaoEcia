<?php


namespace App\Repository;

use GuzzleHttp\Client;
use function Composer\Autoload\includeFile;


class AutodeskAPI
{
    private $generateToken;

    public function __construct()
    {
        $this->generateToken = new Client(['base_uri' => "https://developer.api.autodesk.com/"]);
    }

    public function geraToken()
    {
        $response = $this->generateToken->post('authentication/v1/authenticate', [
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
            'form_params' =>
                [
                    'client_id' => env("AUTODESK_CLIENT_ID"),
                    'client_secret' => env('AUTODESK_CLIENT_SECRET'),
                    'grant_type' => 'client_credentials',
                    'scope' => 'code:all data:write data:read',
                ]
        ]);
        $body = $response->getBody()->getContents();
        $body = explode(',', $body);
        $token_type = explode(':', $body[1]);
        $token_type = $token_type[1];
        $token_type = preg_replace('/"/', '', $token_type);
        $token = explode(':', $body[0]);
        $token = $token[1];
        $token = $token_type . ' ' . preg_replace('/"/', '', $token);
        return $token;
    }

    public function uparArquivo($data)
    {
        $token = $this->geraToken();
        $response = $this->generateToken->post('oss/v2/buckets', [
            'headers' => ["Authorization" => $token],
            'form_params' =>
                [
                    "bucketKey" => $data['name_bucket'],
                    "access" => "full",
                    "policyKey" => "transient"
                ]
        ]);
        $response = $this->generateToken->post('/oss/v2/buckets/' . $data['name_bucket'] . '/objects/OBJECT_KEY_4_REVIT_FILE', [
            'headers' => ["Authorization" => $token],
            'form_params' =>
                [
                    'client_id' => env("AUTODESK_CLIENT_ID"),
                    'client_secret' => env('AUTODESK_CLIENT_SECRET'),
                    'grant_type' => 'client_credentials',
                    'scope' => 'code:all data:write data:read',
                ]
        ]);
    }


}
