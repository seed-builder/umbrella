<?php
/**
 * Created by PhpStorm.
 * User: Shineraini
 * Date: 2017/3/2
 * Time: 10:34
 */

namespace App\Helpers;


use App\Events\WechatApiEvent;
use App\Models\SysLog;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class Utl
{
    /*
     * 微信配置
     */
    public function config()
    {
        $helper = new WeChatConfig();
        $config = $helper->getSignPackage();

        return $config;
    }

    public function token()
    {
        return $this->config()['token'];
    }

    public function get($url, $data = [])
    {
        $client = new Client(['curl' => [CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false]]);

        $data['access_token'] = $this->token();

        $response = $client->request('GET', $url, [
            'query' => $data
        ]);

        $rs = json_decode($response->getBody());

        event(new WechatApiEvent($url, $rs, $data));

        if (!empty($rs->errcode)) {
            dd('系统调试中！');
        }

        return $rs;
    }

    public function post($url, $data = [])
    {
        $client = new Client(['curl' => [CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false]]);

        $response = $client->request('POST', $url, [
            'query' => [
                'access_token' => $this->token()
            ],
            'json' => $data
        ]);

        $rs = json_decode($response->getBody());

        event(new WechatApiEvent($url, $rs, $data));

        return $rs;
    }

    public function post_zh($url, $data = [])
    {
        $client = new Client(['curl' => [CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false]]);

        $response = $client->request('POST', $url, [
            'query' => [
                'access_token' => $this->token()
            ],
            'json_zh' => $data
        ]);

        $rs = json_decode($response->getBody());

        event(new WechatApiEvent($url, $rs, $data));

        return $rs;
    }

    /*
     * 解析文件后缀
     */
    public function mimetype($data)
    {
        $type = $data['Content-Type'][0];

        switch ($type) {
            case "image/gif":
                return '.gif';
                break;
            case "image/jpeg":
                return '.jpeg';
                break;
            case "image/png":
                return '.png';
                break;
            case "image/bmp":
                return '.bmp';
            default:
                return '.jpg';
                break;
        }

    }
}