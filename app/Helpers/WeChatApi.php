<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/5/18
 * Time: 10:25
 */

namespace App\Helpers;


use App\Models\SysLog;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class WeChatApi
{

    public function utl()
    {
        return new Utl();
    }

    /*
     * 获取用户 BY Code
     */
    public function getUserByCode($code)
    {

        $response = $this->utl()->get('https://api.weixin.qq.com/sns/oauth2/access_token', [
            'code' => $code,
            'appid' => env('WECHAT_APPID'),
            'secret' => env('WECHAT_SECRET'),
            'grant_type' => 'authorization_code',
        ]);

        SysLog::create([
            'module' => '请求接口 https://api.weixin.qq.com/sns/oauth2/access_token',
            'action' => '调用微信接口',
            'content' => json_encode($response),
        ]);

        $response = $this->utl()->get('https://api.weixin.qq.com/cgi-bin/user/info', [
            'access_token' => $response->access_token,
            'openid' => $response->openid,
            'lang' => 'zh_CN',
        ]);
        SysLog::create([
            'module' => '请求接口 https://api.weixin.qq.com/cgi-bin/user/info',
            'action' => '调用微信接口',
            'content' => json_encode($response),
        ]);

        return $response;
    }

    /*
     * 下载素材
     */
    public function downResource($id)
    {
        $client = new Client(['curl' => [CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false]]);

        $response = $client->request('GET', 'https://qyapi.weixin.qq.com/cgi-bin/media/get', [
            'query' => [
                'access_token' => $this->utl()->config()['token'],
                'media_id' => $id
            ]
        ]);
        $mimetype = $this->utl()->mimetype($response->getHeaders());

        $url = 'https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=' . $this->utl()->config()['token'] . '&media_id=' . $id;

        if (!file_exists(env('FILE_STORAGE_PATH') . '/customer-image')) {
            mkdir(env('FILE_STORAGE_PATH') . '/customer-image', 0777, true);
        }

        $path = env('FILE_STORAGE_PATH') . '/customer-image' . '/' . date("YmdHis") . uniqid() . $mimetype;
        $client->get($url, ['save_to' => $path]);

        return $path;
    }

}