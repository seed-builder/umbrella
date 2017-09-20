<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatMenuController extends Controller
{
    public function index()
    {
        $utl = new Utl();

        $result = $utl->get('https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info');
        $menus = $result->selfmenu_info->button;
        return view('admin.wechat-menu.index', compact('menus'));
    }

    public function store()
    {
        $utl = new Utl();
        $result = $utl->post_zh('https://api.weixin.qq.com/cgi-bin/menu/create', [
            'button' => [
                [
                    "type" => "scancode_push",
                    'name' => "扫码借伞",
                    'key' => "scan",
                    //扫码url state scanAAeq_sn
                ],
                [
                    "type" => "view",
                    'name' => "共享地图",
                    'key' => "index",
                    'url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf104b58057f98c74&redirect_uri=http%3A%2F%2F7t.chenshuxun.com%2Fmobile%2Fauth-login&response_type=code&scope=snsapi_base&state=CC#wechat_redirect'
                ],
                [
                    "name" => "了解更多",
                    'key' => "center",
                    'sub_button' => [
                        [
                            "type" => "view",
                            "name" => "帮助中心",
                            'url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf104b58057f98c74&redirect_uri=http%3A%2F%2F7t.chenshuxun.com%2Fmobile%2Fauth-login&response_type=code&scope=snsapi_base&state=CC#wechat_redirect'
                        ],
                        [
                            "type" => "view",
                            "name" => "伞客",
                            'url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf104b58057f98c74&redirect_uri=http%3A%2F%2F7t.chenshuxun.com%2Fmobile%2Fauth-login&response_type=code&scope=snsapi_base&state=CC#wechat_redirect'
                        ],
//                        [
//                            "type" => "click",
//                            "name" => "客服电话",
//                            "key" => "phone",
//                            'text' => '111111111'
//                        ]
                    ]
                ],
            ]
        ]);
        dd($result);
    }

    public function proStore()
    {
        $utl = new Utl();
        $result = $utl->post_zh('https://api.weixin.qq.com/cgi-bin/menu/create', [
            'button' => [
                [
                    "type" => "scancode_push",
                    'name' => "扫码借伞",
                    'key' => "scan",
                    //扫码url state scanAAeq_sn
                ],
                [
                    "type" => "view",
                    'name' => "共享地图",
                    'key' => "index",
                    'url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.env('APP_URL').'/mobile/auth-login&response_type=code&scope=snsapi_base&state=CC#wechat_redirect'
                ],
                [
                    "name" => "了解更多",
                    'key' => "center",
                    'sub_button' => [
                        [
                            "type" => "view",
                            "name" => "帮助中心",
                            'url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.env('APP_URL').'/mobile/help/index&response_type=code&scope=snsapi_base&state=CC#wechat_redirect'
                        ],
                        [
                            "type" => "view",
                            "name" => "伞客",
                            'url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.env('APP_URL').'/mobile/auth-login&response_type=code&scope=snsapi_base&state=CC#wechat_redirect'
                        ],
//                        [
//                            "type" => "click",
//                            "name" => "客服电话",
//                            "key" => "phone",
//                            'text' => '111111111'
//                        ]
                    ]
                ],
            ]
        ]);
        dd($result);
    }
}
