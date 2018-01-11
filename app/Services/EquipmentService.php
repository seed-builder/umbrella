<?php
/**
 * Created by PhpStorm.
 * User: szgsj
 * Date: 2018-01-06
 * Time: 5:44
 */
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class EquipmentService
{
    private $server_http_base;

    public function __construct()
    {

    }

    public function init($server_http_base){
        $this->server_http_base = $server_http_base;
    }

    public function changeChannel($equipmentSn, $channelNum, $valid){
        $url = "{$this->server_http_base}/equipment/{$equipmentSn}/set-channel/{$channelNum}";
        $params = ['valid' => $valid];
        $this->httpPost($url, $params);
    }

    public function httpGet($url, $params){
        $client = new Client();
        $res = $client->request('GET', $url, [RequestOptions::QUERY => $params]);
        //$status = $res->getStatusCode();
        return $res->getBody();
    }

    public function httpPost($url, $params){
        $client = new Client();
        $res = $client->request('POST', $url, [RequestOptions::FORM_PARAMS => $params]);
        $status = $res->getStatusCode();
        return $res->getBody();
    }

}