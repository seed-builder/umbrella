/**
 * Created by dell on 2017/6/19.
 */
var Map = function () {

    var markersArray = [];
    var map_key;

    return {
        init: function () {

            options = {
                zoom: 14
            }

            map = new qq.maps.Map(document.getElementById("map"), options);

            this.setLocation();
            // this.mapClick();
        },
        key : function (mapkey) {
            map_key = mapkey;
        },
        initPoint : function (point,callback) {
            this.createMaker(point)
            this.getPoiInfo(point,callback)
        },
        mapClick: function (callback) {
            var self = this;
            qq.maps.event.addListener(map, 'click', function (event) {
                console.log(event)
                self.clearOverlays();
                var point = event.latLng;
                self.createMaker(point)

                self.getPoiInfo(point,callback)
            });
        },
        setLocation: function () {
            var citylocation = new qq.maps.CityService({
                complete: function (result) {
                    map.setCenter(result.detail.latLng);
                }
            });
            citylocation.searchLocalCity();
        },
        clearOverlays: function () {
            if (markersArray) {
                for (i in markersArray) {
                    markersArray[i].setMap(null);
                }
            }
        },
        createMaker: function (point) {
            var marker = new qq.maps.Marker({
                position: point,
                animation: qq.maps.MarkerAnimation.DROP,
                map: map,
                draggable: false,
                visible: true,
            });
            markersArray.push(marker);
        },
        getPoiInfo: function (point,callback) {
            var data = {
                location: point.lat + "," + point.lng,
                key: map_key,
                get_poi: 0
            }
            var url = "http://apis.map.qq.com/ws/geocoder/v1/?";
            data.output = "jsonp";
            $.ajax({
                type: "get",
                dataType: 'jsonp',
                data: data,
                jsonp: "callback",
                jsonpCallback: "QQmap",
                url: url,
                success: function (data) {
                    if (callback) {
                        callback(data.result);
                    }
                },
                error: function (err) {
                    alert("服务端错误，请刷新浏览器后重试")
                }

            })
        },
        searchMap: function (regionId, poiId) {
            var searchService = new qq.maps.SearchService({
                map: map
            });
            searchService.search();
            searchService.setLocation($(regionId).val());
            searchService.search($(poiId).val());
        },

    }
}