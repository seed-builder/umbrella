<?php

namespace App\Helpers;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;


class WeChatConfig
{


    public function getSignPackage()
    {
        $jsapiTicket = $this->getJsApiTicket();
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId" => env('WECHAT_APPID'),
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string,
            "token" => $this->getAccessToken()
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16)
    {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicket()
    {
        $accessToken = $this->getAccessToken();
        $ticket = Cache::get('wxJsApiTicket');

        if (empty($ticket)){
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket";
            $client = new Client(['curl' => [CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false]]); // (修复证书为空SSL报错问题)
            $response = $client->request('GET', $url, [
                'query' => [
                    'type' => 'jsapi',
                    'access_token' => $accessToken,
                ]
            ]);
            $token = json_decode($response->getBody());

            $ticket = $token->ticket;


            Cache::add('wxJsApiTicket', $ticket, 110);
        }
        return $ticket;
    }

    public function getAccessToken($refreshToken = false)
    {
        $access_token = Cache::get('wxAccessToken');

        if (empty($access_token)||$refreshToken){
            $url = "https://api.weixin.qq.com/cgi-bin/token";
            $client = new Client(['curl' => [CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false]]); // (修复证书为空SSL报错问题)
            $response = $client->request('GET', $url, [
                'query' => [
                    'grant_type' => 'client_credential',
                    'appid' => env('WECHAT_APPID'),
                    'secret' => env('WECHAT_SECRET')
                ]
            ]);


            $token = json_decode($response->getBody());

            $access_token = $token->access_token;

            Cache::add('wxAccessToken',$access_token,110);
        }

        return $access_token;
    }


}

?>
