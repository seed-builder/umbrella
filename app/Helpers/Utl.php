<?php
/**
 * Created by PhpStorm.
 * User: Shineraini
 * Date: 2017/3/2
 * Time: 10:34
 */

namespace App\Helpers;


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

//        $this->addLog($rs, $url, $data);

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

//        $this->addLog($rs, $url, $data);

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

//        $this->addLog($rs, $url, $data);

        return $rs;
    }

    public function addLog($rs, $url, $data)
    {
        if (!empty($rs->errcode))
            SysLog::create([
                'name' => '请求接口' . ($rs->errcode == 0 ? '成功' : '失败'),
                'table' => '接口：' . $url,
                'action' => '调用微信接口',
                'content' => '【请求接口数据】：' . json_encode($data) . '【接口返回结果】：' . json_encode($rs),
                'account_id' => !empty(Auth::guard('admin')->user()->id) ? Auth::guard('admin')->user()->id : 0
            ]);
        else
            SysLog::create([
                'name' => '请求接口',
                'table' => '接口：' . $url,
                'action' => '调用微信接口',
                'content' => '【请求接口数据】：' . json_encode($data) . '【接口返回结果】：' . json_encode($rs),
                'account_id' => !empty(Auth::guard('admin')->user()->id) ? Auth::guard('admin')->user()->id : 0
            ]);
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