@extends('mobile.layouts.app')
@section('css')
    <style>
        .content-block-title {
            margin-top: .75rem;
        }

        .service {
            font-size: 13px;
        }

        .service input {
            /*height: .9rem;*/
            margin: .5rem;
            /*width: .5rem;*/
        }

        .radio-item {
            height: .9rem;
            line-height: .9rem;
            display: inline;
        }

        .photo-icon {
            width: 3.5rem;
            height: 3.5rem;
            padding: .5rem;
            border: 1px dashed #b7b4b4;
        }

        .images-list img {
            width: 3.5rem;
            height: 3.5rem;
            margin-left: .5rem;
        }
    </style>
@endsection
@section('content')

    <div class="page page-current" id="register">
        <header class="bar bar-nav">
            <h1 class='title'>柒天伞客</h1>
        </header>
        <div class="content">
            <form id="form-id" action="/mobile/comment/store">
                {{ csrf_field() }}
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="content-block-title">选择服务</div>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-input service">
                                        <div class="radio-item">
                                            <input type="radio" name="service_id" value="1">故障申报
                                        </div>
                                        <div class="radio-item">
                                            <input type="radio" name="service_id" value="2">损坏举报
                                        </div>
                                        <div class="radio-item">
                                            <input type="radio" name="service_id" value="3">疑问咨询
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="content-block-title">反馈描述</div>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-input">
                                        <textarea name="content"></textarea>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="content-block-title">事发地点</div>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="text" name="address" value="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="content-block-title">上传图片</div>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-input images-list">
                                        <img class="photo-icon" src="/images/photo.png">
                                    </div>
                                    <input type="hidden" name="photo_id" id="photo_id" value="">
                                    {{--<input type="hidden" name="photo_id" id="photo_id" value="GHFIKfsMUWh_46Sj8mJibzBnxF63r-RmXW-BW2GsKWLjfG0Tln2dik3-qXS-Uf2l">--}}
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="content-block">
                    <div class="col-100"><a class="button button-big button-fill form-submit">提交反馈</a></div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(".radio-item").click(function () {
            $(this).find('input[type=radio]').attr('checked', true);
        })

        $(".form-submit").on('click', function (e) {
            e.preventDefault();

            var p_ids_str = '';
            serverIds.forEach(function (item, index) {
                if (index == 0)
                    p_ids_str += item;
                else
                    p_ids_str += ',' + item;
            })

            $("#photo_id").val(p_ids_str)
            App.ajaxForm('#form-id');
        })

        $(document).on('click', '.photo-icon', function () {
            wx.chooseImage({
                count: 3,
                sizeType: ['original', 'compressed'],
                sourceType: ['album', 'camera'],
                success: function (res) {
                    var localIds = res.localIds;

                    var html = "";
                    localIds.forEach(function (item) {
                        if ($(".images-list").find('img').length > 4) {
                            $(".images-list").html('<img class="image" src="' + item + '">')
                        } else {
                            $(".images-list").append('<img class="image" src="' + item + '" >');
                        }
                    })
                    syncUpload(localIds);

                }
            });
        })

        var serverIds = new Array();

        function syncUpload(localIds) {
            var localId = localIds.pop();
            wx.uploadImage({
                localId: localId,
                isShowProgressTips: 1,
                success: function (res) {
                    var serverId = res.serverId; // 返回图片的服务器端ID

                    serverIds.push(res.serverId);

                    if (localIds.length > 0) {
                        syncUpload(localIds);
                    }
                }
            });
        }

    </script>
@endsection