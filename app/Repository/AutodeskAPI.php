<?php


namespace App\Repository;

use Autodesk\Auth\Configuration;
use Autodesk\Auth\OAuth2\TwoLeggedAuth;
use Autodesk\Forge\Client\Api\BucketsApi;
use Autodesk\Forge\Client\Model\PostBucketsPayload;
use Autodesk\Forge\Client\Api\ObjectsApi;
use Autodesk\Forge\Client\Api\DerivativesApi;
use Autodesk\Forge\Client\Model\JobPayload;


class AutodeskAPI
{

    public function geraToken()
    {
        Configuration::getDefaultConfiguration()
            ->setClientId(env('FORGE_CLIENT_ID'))
            ->setClientSecret(env('FORGE_CLIENT_SECRET'));

        $twoLeggedAuth = new TwoLeggedAuth();
        $twoLeggedAuth->setScopes(['data:write', 'data:read', 'bucket:create', 'bucket:delete']);

        $twoLeggedAuth->fetchToken();

        $tokenInfo = [
            'applicationToken' => $twoLeggedAuth->getAccessToken(),
            'expiry' => time() + $twoLeggedAuth->getExpiresIn(),
        ];
        return $twoLeggedAuth;
    }

    public function createBucket()
    {

        $token_info = $this->geraToken();
        $data['bucket_key'] = 'belao_e_cia_teste';
        $data['policy_key'] = 'transient';
        $apiInstance = new BucketsApi($token_info);
        $post_buckets = new PostBucketsPayload($data);
        $x_ads_region = "US";

        try {
            $result = $apiInstance->createBucket($post_buckets, $x_ads_region);
            dd($result);
        } catch (Exception $e) {
            echo 'Exception when calling BucketsApi->createBucket: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function verificaBucket()
    {
        $token_info = $this->geraToken();
        $apiInstance = new BucketsApi($token_info);
        $bucket_key = "belao_e_cia_teste"; // string | URL-encoded bucket key

        try {
            $result = $apiInstance->getBucketDetails($bucket_key);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling BucketsApi->getBucketDetails: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function uploadObject()
    {
        $token_info = $this->geraToken();
        $apiInstance = new ObjectsApi($token_info);
        $bucket_key = "belao_e_cia_bucket"; // string | URL-encoded bucket key
        $object_name = "teste_de_upload"; // string | URL-encoded object name
        $content_length = 80; // int | Indicates the size of the request body.
        $body = "file contents";
        $fileHandle = fopen(url('storage/rac_basic_sample_project.rvt'), 'r+'); // File resource handle
        $content_disposition = "content_disposition_example"; // string | The suggested default filename when downloading this object to a file after it has been uploaded.
        $if_match = "if_match_example"; // string | If-Match header containing a SHA-1 hash of the bytes in the request body can be sent by the calling service or client application with the request. If present, OSS will use the value of If-Match header to verify that a SHA-1 calculated for the uploaded bytes server side matches what was sent in the header. If not, the request is failed with a status 412 Precondition Failed and the data is not written.

        try {
            //Upload file contents
            $resultUploadContent = $apiInstance->uploadObject($bucket_key, $object_name, $content_length, $body, $content_disposition, $if_match);
            print_r($resultUploadContent);
            //Upload file as stream
            $resultUploadFile = $apiInstance->uploadObject($bucket_key, $object_name, $content_length, $fileHandle, $content_disposition, $if_match);
            print_r($resultUploadFile);
        } catch (Exception $e) {
            echo 'Exception when calling ObjectsApi->uploadObject: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function translate()
    {
        $token_info = $this->geraToken();
        $apiInstance = new DerivativesApi($token_info);
        $job = new JobPayload(); // \Autodesk\Forge\Client\Model\JobPayload |
        $x_ads_force = false; // bool | `true`: the endpoint replaces previously translated output file types with the newly generated derivatives  `false` (default): previously created derivatives are not replaced

        try {
            $result = $apiInstance->translate($job, $x_ads_force);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling DerivativesApi->translate: ', $e->getMessage(), PHP_EOL;
        }
    }



}
