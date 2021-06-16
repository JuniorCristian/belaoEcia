<?php


namespace App\Repository;

use Autodesk\Auth\Configuration;
use Autodesk\Auth\OAuth2\TwoLeggedAuth;
use Autodesk\Forge\Client\Api\BucketsApi;
use Autodesk\Forge\Client\Model\PostBucketsPayload;
use Autodesk\Forge\Client\Api\ObjectsApi;
use Autodesk\Forge\Client\Api\DerivativesApi;
use Autodesk\Forge\Client\Model\JobPayload;
use PhpParser\Builder\Class_;
use PhpParser\Node\Expr\Cast\Object_;
use function Psy\bin;


class AutodeskAPI
{

    public function geraToken()
    {
        Configuration::getDefaultConfiguration()
            ->setClientId(env('FORGE_CLIENT_ID'))
            ->setClientSecret(env('FORGE_CLIENT_SECRET'));

        $twoLeggedAuth = new TwoLeggedAuth();
        $twoLeggedAuth->setScopes(['data:write', 'data:read', 'bucket:create', 'bucket:delete', 'bucket:read']);

        $twoLeggedAuth->fetchToken();

        $tokenInfo = [
            'applicationToken' => $twoLeggedAuth->getAccessToken(),
            'expiry' => time() + $twoLeggedAuth->getExpiresIn(),
        ];
        return $twoLeggedAuth;
    }

    public function createBucket($data)
    {

        $token_info = $data->token;
        $dataBucket['bucket_key'] = $data->bucket_name;
        $dataBucket['policy_key'] = 'transient';
        $apiInstance = new BucketsApi($token_info);
        $post_buckets = new PostBucketsPayload($dataBucket);
        $x_ads_region = "US";

        try {
            $result = $apiInstance->createBucket($post_buckets, $x_ads_region);
            return true;
        } catch (Exception $e) {
            echo 'Exception when calling BucketsApi->createBucket: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function verificaBucket($data)
    {
        $token_info = $data->token;
        $apiInstance = new BucketsApi($token_info);
        $bucket_key = $data->bucket_name;

        try {
            $result = $apiInstance->getBucketDetails($bucket_key);
            return $result;
        } catch (Exception $e) {
            echo 'Exception when calling BucketsApi->getBucketDetails: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function uploadObject($data)
    {
        $token_info = $data->token;
        $verificaBucket = $this->verificaBucket($data);
        if(!isset($verificaBucket['bucket_key']) || $verificaBucket['bucket_key'] != $data->bucket_name){
            $this->createBucket($data);
        }
        $bucket_key = "belao_e_cia_bucket_teste_aaaaaaaaaaa"; // string | URL-encoded bucket key
        $object_name = "teste_basic_sample_project.rvt"; // string | URL-encoded object name
        $bucket_key = $data->bucket_name; // string | URL-encoded bucket key
        $object_name = $data->file_name; // string | URL-encoded object name

        $path = public_path($data->file);
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://developer.api.autodesk.com/oss/v2/buckets/' . $bucket_key . '/objects/'.$object_name);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array('@/home/cristian/Downloads/rstbasicsampleproject.rvt'));
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/octet-stream',
                'Cookie: PF=CNbNVuFQQunmOJh7jOBU5T',
                'Authorization: Bearer ' . $token_info->getAccessToken(),
                'Accept-Encoding: gzip, deflate',
//                "'" . fread(fopen(public_path('storage/rac_basic_sample_project.rvt'), 'r+'), filesize(public_path('storage/rac_basic_sample_project.rvt'))) . "'"
            ]);
            dd($curl);

            $result = curl_exec($curl);
            $retorno = json_decode($result, true);
        } catch (Exception $e) {
            return $e;
        } finally {
            curl_close($curl);
        }
        return $retorno;
    }

    public function translate($data)
    {
        $token_info = $data->token;
        $apiInstance = new DerivativesApi($token_info);
        $job = new JobPayload(); // \Autodesk\Forge\Client\Model\JobPayload |
        $input = ["urn" => base64_encode($this->uploadObject($data)["objectId"])];
//        $input = ["urn" => base64_encode("urn:adsk.objects:os.object:belao_e_cia_bucket_teste_aaaaaaaaaaa/rst_basic_sample_project.rvt")];
        $ouput = ["destination" => ["region" => "us"], "formats" => [["type" => "svf", "views" => ["3d"]]]];
        $job->setInput($input);
        $job->setOutput($ouput);
        $x_ads_force = false; // bool | `true`: the endpoint replaces previously translated output file types with the newly generated derivatives  `false` (default): previously created derivatives are not replaced

        try {
            $result = $apiInstance->translate($job, $x_ads_force);
            return $result;
        } catch (Exception $e) {
            echo 'Exception when calling DerivativesApi->translate: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function getManifest($data)
    {
        $token_info = $data->token;
        //$translate = $this->translate($data);
        $urn = "dXJuOmFkc2sub2JqZWN0czpvcy5vYmplY3Q6YmVsYW9fZV9jaWFfYnVja2V0X3Rlc3RlX2FhYWFhYWFhYWFhL3JzdF9iYXNpY19zYW1wbGVfcHJvamVjdC5ydnQ";
//        if (isset($translate['result']) && $translate['result'] === "created") {
//            $urn = $translate['urn']; // string | The Base64 (URL Safe) encoded design URN
//        } else {
//            return false;
//        }
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://developer.api.autodesk.com/modelderivative/v2/designdata/' . $urn . '/manifest');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $token_info->getAccessToken(),
            ]);
            do {
                sleep(4);
                $result = curl_exec($curl);
                $retorno = json_decode($result, true);
            } while ($retorno['progress'] != "complete");
            return $retorno;
        } catch (Exception $e) {
            return $e;
        } finally {
            curl_close($curl);
        }
    }

    public function getMetadata($data)
    {
        $token_info = $data->token;
        $urn = $data->manifest['urn'];
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://developer.api.autodesk.com/modelderivative/v2/designdata/' . $urn . '/metadata');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $token_info->getAccessToken(),
            ]);
            $result = curl_exec($curl);
            $retorno = json_decode($result, true);
            return $retorno;
        } catch (Exception $e) {
            return $e;
        } finally {
            curl_close($curl);
        }
    }

    public function getModelDerivativeProperties($data)
    {
        $token_info = $this->geraToken();
        $data->token = $token_info;
        $manifest = $this->getManifest($data);
        $data->manifest = $manifest;
        $metadata = $this->getMetadata($data);
        $urn = $manifest['urn'];
        foreach ($metadata['data']['metadata'] as $meta){
            if($meta['role'] = '3d'){
                $guid = $meta['guid'];
                break;
            }
        }

        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://developer.api.autodesk.com/modelderivative/v2/designdata/' . $urn . '/metadata/'.$guid.'/properties');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $token_info->getAccessToken(),
            ]);
            $result = curl_exec($curl);
            curl_close($curl);
            $retorno = json_decode($result, true);
            return $retorno;
        } catch (Exception $e) {
            return $e;
        }
    }

}
