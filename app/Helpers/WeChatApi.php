<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/5/18
 * Time: 10:25
 */

namespace App\Helpers;


use App\Events\WechatApiEvent;
use App\Helpers\WeChatLib\WxPayEnterprise;
use App\Models\Resource;
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
        $response = $client->request('GET', 'https://api.weixin.qq.com/cgi-bin/media/get', [
            'query' => [
                'access_token' => $this->utl()->token(),
                'media_id' => $id
            ]
        ]);

        $mimetype = $this->utl()->mimetype($response->getHeaders());

        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token=' . $this->utl()->config()['token'] . '&media_id=' . $id;

        if (!file_exists(storage_path() . '/wechat-images/')) {
            mkdir(storage_path() . '/wechat-images/', 0777, true);
        }

        $path = storage_path('wechat-images/' . date("YmdHis") . uniqid() . $mimetype);

        $client->get($url, ['save_to' => $path]);

        $file = new Resource([
            'name' => $id,
            'mimetype' => $mimetype,
            'path' => $path,
        ]);
        $file->save();
        return $file->id;
    }

    /**
     * 微信消息推送
     * @param $template_type
     * @param $data
     * @param $openId
     * @param null $url
     */
    public function wxSend($template_id, $messages, $open_id, $url = null)
    {
        foreach ($messages as $k=>$message){
            $messages[$k] = [
                'value' => $message
            ];
        }

        $data = [
            'touser' => $open_id,
            'template_id' => $this->template($template_id), // 模板id
            'data' => $messages
        ];

//        if (!empty($url)){
//            $real = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx4b0fecc759183d45&redirect_uri=http://'.env('APP_URL').'&response_type=code&scope=snsapi_userinfo&state='.$url.'#wechat_redirect';
//            $data['url'] = $real;
//        }

        return $this->utl()->post('https://api.weixin.qq.com/cgi-bin/message/template/send', $data);
    }

    /**
     * 生成企业向个人付款订单
     * @param $withdraw
     * @return array
     */
    public function epPay($withdraw)
    {
        $input = new WxPayEnterprise();

        $input->setOpenid($withdraw->customer->openid);
        $input->setCheck_name('NO_CHECK');
        $input->setPartner_trade_no($withdraw->sn);
        $input->setAmount($withdraw->amt * 100);
        $input->setDesc(env('PROJECT_NAME') . '账户提现');

        $pay = new WeChatPay();
        $result = $pay->enterprisePay($input);

        event(new WechatApiEvent('企业向个人付款', $result, $input));

        return $result;
    }


    /**
     * 消息模板
     * @param $id
     * @return mixed
     */
    protected function template($id)
    {
        $data = [
            'expired' => env('WT_EXPIRED'),
            'borrow' => env('WT_BORROW'),
            'return' => env('WT_RETURN'),
        ];

        return $data[$id];
    }


}