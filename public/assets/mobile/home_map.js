/**
 * Created by dell on 2017/6/20.
 */
define(function (require, exports, module) {
    exports.index = function ($) {

        var map, sites;

        map = new AMap.Map('map', {
            zoom: 10,
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

            controlUI.innerHTML = '<a href="#" id="QR" class="button button-big button-fill" ><img src="/images/icon/icon_scanQR_white.png">扫码借伞</a>';

            controlUI.onclick = function () {
                if (!enough_deposit) {
                    $.router.loadPage("/mobile/customer-account/deposit?index=deposit");
                    return
                }
                wx.scanQRCode({
                    desc: 'scanQRCode desc',
                    needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                    scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                    success: function (res) {
                        // 回调
                    },
                    error: function (res) {
                        if (res.errMsg.indexOf('function_not_exist') > 0) {
                            alert('版本过低请升级')
                        }
                    }
                });
            }
            createControl(controlUI);
        }

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
                wechatLocation();
            }
            createControl(controlUI);
        }

        /**
         * 微信jssdk定位
         */
        var wechatLocation = function () {
            wx.getLocation({
                type: 'gcj02',
                success: function (res) {
                    var latitude = res.latitude;
                    var longitude = res.longitude;

                    map.setZoomAndCenter(14, [longitude, latitude]);
                    var marker = new AMap.Marker({
                        map: map,
                        position: [longitude, latitude]
                    });
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
            });

        }

        init();
    }
})