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

        $auth_info = $this->utl()->get('https://api.weixin.qq.com/sns/oauth2/access_token', [
            'code' => $code,
            'appid' => env('WECHAT_APPID'),
            'secret' => env('WECHAT_SECRET'),
            'grant_type' => 'authorization_code',
        ]);

        $response = $this->utl()->get('https://api.weixin.qq.com/cgi-bin/user/info', [
            'openid' => $auth_info->openid,
            'lang' => 'zh_CN',
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

    /**
     * 微信消息推送
     * @param $template_type
     * @param $data
     * @param $openId
     * @param null $url
     */
    public function wxSend($template_id, $data, $open_id, $url = null)
    {
        $data = [
            'touser' => $open_id,
            'template_id' => $this->template($template_id), // 模板id
            'data' => $data
        ];

        if (!empty($url))
            $data['url'] = $url;

        $this->send($data);
    }

    /**
     * 推送
     * @param $data
     */
    protected function send($data)
    {
        $token = $this->utl()->config()['token'];

        $curl = curl_init();
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // 设置post变量
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl); // 执行
        curl_close($curl);
    }

    protected function template($id)
    {
        $data = [
            'rf' => '1jpgnu05QiAIA-9IRyXaZcACCQraPjuQcuerIr57IP4',
        ];

        return $data[$id];
    }

}