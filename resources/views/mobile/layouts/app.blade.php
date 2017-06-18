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
    @yield('css')
    <script type='text/javascript' src='/js/app.js' charset='utf-8'></script>
</head>
<body>
<div class="page-group"  id="app">

        @yield('content')
        {{--@yield('map_buttons')--}}
        {{--@include('mobile.layouts.toolbar')--}}
</div>


<script type='text/javascript' src='/mobile/light7/js/light7.min.js' charset='utf-8'></script>
<script type='text/javascript' src='/mobile/Shineraini/js/app.js' charset='utf-8'></script>
<script type='text/javascript' src='/mobile/layer_mobile/layer.js' charset='utf-8'></script>
<script type='text/javascript' src='/mobile/Shineraini/js/page.js' charset='utf-8'></script>
<script>
    $(".link").on('click',function () {
        var url = $(this).data('url')
        if (url!=null){
            window.location.href = url;
        }
    })
</script>
@yield('javascript')
</body>
</html>
