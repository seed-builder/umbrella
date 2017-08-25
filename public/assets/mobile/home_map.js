/**
 * Created by dell on 2017/6/20.
 */
define(function (require, exports, module) {
    exports.index = function ($) {

        var map, sites;
        var golang_host = 'http://119.23.214.176:4000/'

        map = new AMap.Map('map', {
            zoom: 12,
            resizeEnable: true
        });

        map.setMapStyle('amap://styles/479729a2d3aab261e939ebd11c35790b');

        wx.ready(function () {
            wechatLocation();
        });


        /**
         * 自定义控件-个人中心
         */
        var myControl = function () {
            var controlUI = document.createElement("DIV");

            controlUI.style.width = '80px';
            controlUI.style.position = 'absolute';
            controlUI.style.left = '85%';
            controlUI.style.top = '1%';
            controlUI.style.zIndex = '300';

            controlUI.innerHTML = '<div class="map-btn"><img src="/images/icon/icon_my.png"></div>';

            controlUI.onclick = function () {
                $.openPanel("#my-panel");
            }
            createControl(controlUI);
        }

        /**
         * 自定义控件-扫码
         */
        var qrControl = function () {
            var controlUI = document.createElement("DIV");

            controlUI.style.position = 'absolute';
            controlUI.style.left = '25%';
            controlUI.style.top = '85%';
            controlUI.style.width = '50%';
            controlUI.style.zIndex = '300';

            controlUI.innerHTML = '<a href="#" id="QR" class="button button-black button-big button-fill" ><img src="/images/icon/icon_scanQR_white.png">扫码借伞</a>';

            var self = this;

            controlUI.onclick = function () {
                // if (!enough_deposit) {
                //     $.router.loadPage("/mobile/customer-account/deposit?index=deposit");
                //     return
                // }

                $.get('/mobile/customer-account/check',{},function (data) {
                    if (data.code==500){
                        layer.open({
                            content: data.message
                            , btn: '我知道了'
                        });
                    }else if(data.code==501){
                        $.router.loadPage("/mobile/customer-account/deposit?index=deposit");
                        return
                    }else {
                        layer.open({
                            content: '共享伞解锁'
                            ,btn: ['手动输入','扫码借伞']
                            ,skin: 'footer'
                            ,yes: function(index){
                                layer.closeAll()
                                // $.popup('.unlock-umbrella')
                                layer.open({
                                    type: 1
                                    ,content: '<div class="content-block unblock-content">' +
                                    '<input type="number" id="umbrella-sn" placeholder="请输入伞柄上的数字"/>' +
                                    '<input type="button" id="unlock-submit" value="立即用伞">' +
                                    '</div>'
                                    ,anim: 'up'
                                    ,style: 'position:fixed; bottom:0; left:0; width: 100%; height: 200px; padding:10px 0; border:none;'
                                    ,success:function () {
                                        $("#umbrella-sn").focus()
                                    }
                                });
                            },
                            no : function(index){
                                wx.scanQRCode({
                                    desc: 'scanQRCode desc',
                                    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                                    scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                                    success: function (res) {
                                        var url = golang_host+'customer/'+customer_id+'/hire/'+res.resultStr;
                                        layer.open({
                                            type: 2,
                                            shadeClose: false
                                            , content: '系统正在出伞，请稍等15秒左右...'
                                        });
                                        $.post(url,{},function (data) {
                                            if (data.success){
                                                timer = setInterval(function () {
                                                    checkHire(data.hire_id);
                                                }, 8000);
                                            }
                                        })
                                    },
                                    error: function (res) {
                                        if (res.errMsg.indexOf('function_not_exist') > 0) {
                                            alert('版本过低请升级')
                                        }
                                    }
                                });
                                layer.closeAll()
                            }
                        });
                    }
                })

                // layer.open({
                //     content: '共享伞解锁'
                //     ,btn: ['手动输入','扫码借伞']
                //     ,skin: 'footer'
                //     ,yes: function(index){
                //         layer.closeAll()
                //         // $.popup('.unlock-umbrella')
                //         layer.open({
                //             type: 1
                //             ,content: '<div class="content-block unblock-content">' +
                //             '<input type="number" id="umbrella-sn" placeholder="请输入伞柄上的数字"/>' +
                //             '<input type="button" id="unlock-submit" value="立即用伞">' +
                //             '</div>'
                //             ,anim: 'up'
                //             ,style: 'position:fixed; bottom:0; left:0; width: 100%; height: 200px; padding:10px 0; border:none;'
                //             ,success:function () {
                //                 $("#umbrella-sn").focus()
                //             }
                //         });
                //     },
                //     no : function(index){
                //         wx.scanQRCode({
                //             desc: 'scanQRCode desc',
                //             needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                //             scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                //             success: function (res) {
                //                 var url = golang_host+'customer/'+customer_id+'/hire/'+res.resultStr;
                //                 layer.open({
                //                     type: 2,
                //                     shadeClose: false
                //                     , content: '系统正在出伞，请稍等15秒左右...'
                //                 });
                //                 $.post(url,{},function (data) {
                //                     if (data.success){
                //                         timer = setInterval(function () {
                //                             checkHire(data.hire_id);
                //                         }, 8000);
                //                     }
                //                 })
                //             },
                //             error: function (res) {
                //                 if (res.errMsg.indexOf('function_not_exist') > 0) {
                //                     alert('版本过低请升级')
                //                 }
                //             }
                //         });
                //         layer.closeAll()
                //     }
                // });

            }
            createControl(controlUI);
        }

        $(document).on('click','#unlock-submit',function (e) {
            e.preventDefault();
            var number = $("#umbrella-sn").val()
            if (!sn){
                layer.open({
                    content: '请输入伞柄上的数字'
                    ,btn: '我知道了'
                });
                return ;
            }
            layer.open({
                type: 2
                , content: '解锁中...'
            });
            App.ajaxLink('/mobile/umbrella/unlock?number='+number)
        })

        /**
         * 自定义控件-定位
         */
        var wechatLocationControl = function () {
            var controlUI = document.createElement("DIV");

            controlUI.style.position = 'absolute';
            controlUI.style.left = '1%';
            controlUI.style.top = '84.5%';
            controlUI.style.zIndex = '300';

            controlUI.innerHTML = '<div class="map-btn" id="location"><img src="/images/icon/icon_location.png"></div>';

            controlUI.onclick = function () {
                loactionMarker.setMap(null);
                wechatLocation();
            }
            createControl(controlUI);
        }

        /**
         * 微信jssdk定位
         */
        var loactionMarker ;
        var wechatLocation = function () {
            // loactionMarker.setMap(null);
            wx.getLocation({
                type: 'gcj02',
                success: function (res) {
                    var latitude = res.latitude;
                    var longitude = res.longitude;

                    map.setZoomAndCenter(12, [longitude, latitude]);

                    loactionMarker = new AMap.Marker({
                        position: [longitude, latitude]
                    });
                    loactionMarker.setMap(map)
                },
                cancel: function (res) {
                    layer.open({
                        content: '您已拒绝了授权获取地理位置，要授权才能定位到您的位置哦'
                        , btn: '我知道了'
                    });
                },
            });
        }

        /**
         * 创建自定义控件
         */
        var createControl = function (control) {
            AMap.homeControlDiv = function () {
            }

            AMap.homeControlDiv.prototype = {
                addTo: function (map, dom) {
                    dom.appendChild(this._getHtmlDom(map));
                },
                _getHtmlDom: function (map) {
                    this.map = map;

                    return control;
                },
            }

            var homeControl = new AMap.homeControlDiv(map);
            map.addControl(homeControl);
        }

        /**
         * 创建标注
         * @param point
         * @returns {AMap.Marker}
         */
        var createMarker = function (point) {
            if (!point) {
                return;
            }

            var marker = new AMap.Marker({
                // icon: "http://webapi.amap.com/theme/v1.3/markers/n/mark_b.png",
                icon: "/images/icon/icon_site.png",
                position: point
            });
            marker.setMap(map);

            return marker;
        }

        /**
         * 获取网点列表
         */
        var getSites = function () {
            App.ajaxData('/mobile/site/pagination?length=9999', function (data) {
                sites = data;
                for (i in data) {
                    var marker = createMarker([data[i].longitude, data[i].latitude])

                    infoWindow(marker,data[i]);
                }
            })
        }

        /**
         * 信息窗口
         * @param marker
         * @param data
         */
        var infoWindow = function (marker, data) {
            AMapUI.defineTpl("ui/overlay/SimpleInfoWindow/tpl/container.html", [], function () {
                return document.getElementById('info-window').innerHTML;
            });
            AMapUI.loadUI(['overlay/SimpleInfoWindow'], function (SimpleInfoWindow) {
                var infoWindow = new SimpleInfoWindow({
                    site_name: data.name,
                    have: data.umbrella_hava,
                    repay: data.umbrella_repay,

                    //基点指向marker的头部位置
                    offset: new AMap.Pixel(0, -30)
                });

                function openInfoWin() {
                    infoWindow.open(map, marker.getPosition());
                }

                //marker 点击时打开
                AMap.event.addListener(marker, 'click', function () {
                    openInfoWin();
                });

            });

        }

        var checkHire = function (id) {
            $.get('/mobile/customer-hire/check/'+id,{},function (data) {
                if (data.code==0){
                    layer.closeAll();
                    clearInterval(timer);
                    layer.open({
                        content:'出伞成功，请到机器上领取您的伞'
                        , btn: '我知道了'
                    });
                }
            })
        }

        /**
         * 定时器
         */
        var timer;

        /**
         * 初始化
         */
        var init = function () {
            myControl();
            qrControl();
            wechatLocationControl();
            getSites();

            map.on('click', function(e) {
                $(".amap-ui-infowindow-close").trigger('click');
                $.closePanel("#my-panel");
            });

        }

        init();
    }
})