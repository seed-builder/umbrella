<?php
$helper = new \App\Helpers\WeChatConfig();
$config = $helper->getSignPackage();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>共享雨伞</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="_token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="/mobile/light7/css/light7.css">
    <link rel="stylesheet" href="/mobile/Shineraini/css/style.css">
    <link rel="stylesheet" href="/mobile/Shineraini/css/icon.css">
    <link rel="stylesheet" href="/mobile/layer_mobile/need/layer.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//at.alicdn.com/t/font_du1thdwu0hdrt3xr.css" rel="stylesheet">

    @yield('css')
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>

    <script type='text/javascript' src='/js/app.js' charset='utf-8'></script>
    <script src="/assets/sea.js"></script>
</head>
<body>
<div class="page-group"  id="app">

        @yield('content')
        {{--@yield('map_buttons')--}}
        {{--@include('mobile.layouts.toolbar')--}}
</div>


<script type='text/javascript' src='//at.alicdn.com/t/font_du1thdwu0hdrt3xr.js' charset='utf-8'></script>
<script type='text/javascript' src='/mobile/light7/js/light7.min.js' charset='utf-8'></script>
<script type='text/javascript' src='/mobile/Shineraini/js/app.js' charset='utf-8'></script>
<script type='text/javascript' src='/mobile/layer_mobile/layer.js' charset='utf-8'></script>
<script type='text/javascript' src='/mobile/Shineraini/js/page.js' charset='utf-8'></script>
<script>
    $(document).on('click','.link',function () {
        var url = $(this).data('url')
        if (url!=null){
            window.location.href = url;
        }
    })

    $(document).on('click','.ajax-link',function () {
        var url = $(this).data('url')
        if (url!=null){
            $.router.loadPage(url);
        }
    })

    wx.config({
        debug: false,
        appId: '{{$config['appId']}}',
        timestamp:'{{$config['timestamp']}}' ,
        nonceStr: '{{$config['nonceStr'] }}',
        signature: '{{$config['signature'] }}',
        jsApiList: [
            'openEnterpriseChat',
            'openEnterpriseContact',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'onMenuShareQZone',
            'startRecord',
            'stopRecord',
            'onVoiceRecordEnd',
            'playVoice',
            'pauseVoice',
            'stopVoice',
            'onVoicePlayEnd',
            'uploadVoice',
            'downloadVoice',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'translateVoice',
            'getNetworkType',
            'openLocation',
            'getLocation',
            'hideOptionMenu',
            'showOptionMenu',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'closeWindow',
            'scanQRCode',
        ]
    });
</script>

@yield('javascript')
</body>
</html>
