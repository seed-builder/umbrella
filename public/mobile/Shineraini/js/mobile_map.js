/**
 * Created by dell on 2017/6/13.
 */
var MapTool = function () {
    var options = {};
    var map;

    return {
        init : function () {
            var self = this;
            options = {
                zoom: 14,
                zoomControl : false,
                panControl: false,
            }
            this.h5Location();

            map = new qq.maps.Map(document.getElementById("map"), options);

            this.QRControl();
            this.myControl();
            this.accountControl();
            this.recordControl();
            this.helpControl();
            this.createMarker();


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
        createMarker : function () {
            var center = new qq.maps.LatLng(24.479834, 118.089425);

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
            var button = document.createElement("div");
            button.innerHTML = '<div class="map-btn"><img src="/images/icon/icon_help.png"></div>'

            qq.maps.event.addListener(button, "click", this.help);
            map.controls[qq.maps.ControlPosition.RIGHT_CENTER].push(button);
        },
        help : function () {
            alert('帮助中心');
        },
        accountControl : function () {
            var button = document.createElement("div");
            button.innerHTML = '<div class="map-btn"><img src="/images/icon/icon_account.png"></div>'

            qq.maps.event.addListener(button, "click", this.account);
            map.controls[qq.maps.ControlPosition.RIGHT_CENTER].push(button);
        },
        account : function () {
            $.router.loadPage("/mobile/customer-account/index");
        },
        recordControl : function () {
            var button = document.createElement("div");
            button.innerHTML = '<div class="map-btn"><img src="/images/icon/icon_money_record_orange.png"></div>'

            qq.maps.event.addListener(button, "click", this.record);
            map.controls[qq.maps.ControlPosition.RIGHT_CENTER].push(button);
        },
        record : function () {
            // $.router.loadPage("/mobile/customer-payment/index");
            window.location.href="/mobile/customer-payment/index";
        },
        myControl : function () {
            var button = document.createElement("div");
            button.innerHTML = '<div class="map-btn"><img src="/images/icon/icon_my1.png"></div>'

            qq.maps.event.addListener(button, "click", this.my);
            map.controls[qq.maps.ControlPosition.RIGHT_CENTER].push(button);
        },
        my : function () {
            $.router.loadPage("/mobile/customer/view");
        },

    }
}

$(function () {
    var mapTool = new MapTool();
    mapTool.init();
})