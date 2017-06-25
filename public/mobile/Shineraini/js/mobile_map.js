/**
 * Created by dell on 2017/6/13.
 */
var MapTool = function () {
    var options = {};
    var map;
    var geolocation;

    return {
        init : function () {
            var self = this;
            options = {
                zoom: 14,
                zoomControl : false,
                panControl: false,
            }
            map = new qq.maps.Map(document.getElementById("map"), options);

            this.h5Location();
            // this.wechatLocation();
            this.QRControl();
            this.myControl();
            this.accountControl();
            this.paymentControl();
            this.hireControl();
            this.moneyRecordControl();
            this.helpControl();
            this.wechatLocationControl();
            // this.createMarker(new qq.maps.LatLng(24.479834, 118.089425));

            $("#location").trigger('click')

        },
        h5Location : function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(this.locationSuccess,this.locationError);
            }
            else {
                alert('当前浏览器不支持定位');
            }
        },
        locationSuccess : function (position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            qq.maps.convertor.translate(new qq.maps.LatLng(lat, lng), 1, function (res) {

            });
        },
        locationError : function () {
            //h5定位失败 自动定位到当前城市中心
            var citylocation = new qq.maps.CityService({
                complete : function(result){
                    map.setCenter(result.detail.latLng);
                }
            });
            citylocation.searchLocalCity();
        },
        createMarker : function (point) {
            var center = point ;

            var anchor = new qq.maps.Point(0, 39),
                size = new qq.maps.Size(100, 100),
                origin = new qq.maps.Point(0, 0),
                icon = new qq.maps.MarkerImage(
                    "/images/icon/icon_umbrella_marker_orange.png"
                    // size
                    // origin
                    // anchor
                );

            var marker = new qq.maps.Marker({
                map: map,
                position: center
            });

            marker.setIcon(icon);
        },
        QRControl : function () {
            var QRButton = document.createElement("div");
            QRButton.innerHTML = '<a href="#" id="QR" class="button button-big button-fill" ><img src="/images/icon/icon_scanQR_white.png">扫码借伞</a>'

            QRButton.index = 1;
            qq.maps.event.addListener(QRButton, "click", this.scanQR);
            map.controls[qq.maps.ControlPosition.BOTTOM_CENTER].push(QRButton);
        },
        scanQR:function () {
            wx.scanQRCode({
                desc: 'scanQRCode desc',
                needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                success: function (res) {
                    // 回调
                },
                error: function(res){
                    if(res.errMsg.indexOf('function_not_exist') > 0){
                        alert('版本过低请升级')
                    }
                }
            });
        },
        helpControl : function () {
            var html = '<div class="map-btn"><img src="/images/icon/icon_help.png"></div>';
            this.createControl(html,this.help);
        },
        help : function () {
            alert('帮助中心');
        },
        accountControl : function () {
            var html = '<div class="map-btn"><img src="/images/icon/icon_account.png"></div>';
            this.createControl(html,this.account);
        },
        account : function () {
            $.router.loadPage("/mobile/customer-account/index");
        },
        paymentControl : function () {
            var html = '<div class="map-btn"><img src="/images/icon/icon_payment_orange.png"></div>';
            this.createControl(html,this.payment);
        },
        payment : function () {
            // $.router.loadPage("/mobile/customer-payment/index");
            window.location.href="/mobile/customer-payment/index";
        },
        moneyRecordControl : function () {
            var html = '<div class="map-btn"><img src="/images/icon/icon_money_record_red.png"></div>';
            this.createControl(html,this.moneyRecord);
        },
        moneyRecord : function () {
            // $.router.loadPage("/mobile/customer-payment/index");
            window.location.href="/mobile/customer-account-record/index";
        },
        myControl : function () {
            var html = '<div class="map-btn"><img src="/images/icon/icon_my1.png"></div>';
            this.createControl(html,this.my);
        },
        my : function () {
            $.router.loadPage("/mobile/customer/view");
        },
        hireControl : function () {
            var html = '<div class="map-btn"><img src="/images/icon/icon_umbrella1.png"></div>';
            this.createControl(html,this.hire);
        },
        hire : function () {
            // $.router.loadPage("/mobile/customer-hire/index");
            window.location.href="/mobile/customer-hire/index";

        },
        createControl : function (html,callback,position) {
            var button = document.createElement("div");
            button.innerHTML = html;

            qq.maps.event.addListener(button, "click", callback);
            if (position)
                map.controls[position].push(button);
            else
                map.controls[qq.maps.ControlPosition.RIGHT_CENTER].push(button);
        },
        wechatLocationControl : function () {
            var html = '<div class="map-btn" id="location"><img src="/images/icon/icon_location.png"></div>';
            this.createControl(html,this.wechatLocation,qq.maps.ControlPosition.LEFT_BOTTOM);
        },
        wechatLocation : function () {
            var self = this;
            wx.getLocation({
                type: 'gcj02',
                success: function (res) {
                    var latitude = res.latitude;
                    var longitude = res.longitude;

                    var point = new qq.maps.LatLng(latitude, longitude);
                    var marker = new qq.maps.Marker({
                        map: map,
                        position: point,
                        animation:qq.maps.MarkerAnimation.DROP
                    });

                    map.panTo(point);
                },
                cancel: function (res) {
                    layer.open({
                        content: '您已拒绝了授权获取地理位置，要授权才能定位到您的位置哦'
                        , btn: '我知道了'
                    });
                }
            });
        }
    }
}

$(function () {
    var mapTool = new MapTool();
    mapTool.init();
})