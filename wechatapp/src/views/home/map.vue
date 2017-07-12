<template>
    <div id="map">

    </div>
</template>


<script>
    export default {
        mounted() {
            this.init()
        },
        components: {
        },
        data () {
            return {
                map : new AMap.Map('map')
            }
        },
        methods : {
            init : function () {
                var height = window.screen.height;
                $("#map").height(height)

                this.map = new AMap.Map('map', {
                    zoom: 12,
                    resizeEnable: true
                });

                this.map.setMapStyle('amap://styles/479729a2d3aab261e939ebd11c35790b');
                this.myControl();

            },
            myControl : function () {
                var controlUI = document.createElement("DIV");

                controlUI.style.width = '80px';
                controlUI.style.position = 'absolute';
                controlUI.style.left = '85%';
                controlUI.style.top = '1%';
                controlUI.style.zIndex = '300';

                controlUI.innerHTML = '<div class="map-btn"><svg class="icon map-icon " aria-hidden="true"><use xlink:href="#icon-wode"></use></svg></div>';

                var self = this;
                controlUI.onclick = function () {
                    self.routeTo('/home/index');
                }
                this.createControl(controlUI);
            },

            createControl : function (control) {
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
                this.map.addControl(homeControl);
            },
            routeTo : function (url) {
                this.$router.push({path:url})
            }
        }
    }


</script>

<style>
    #QR{
        margin-bottom: 2rem;
        border-radius: 1.1rem;
        background: black;
    }

    #QR img {
        height: 1.5rem;
        width: 1.5rem;
        vertical-align:middle;
        margin-right: 5%;
    }

    #location {
        margin-left: 1rem;
        margin-bottom: 1.25rem;
    }

    .map-btn {
        width: 2.5rem;
        height: 2.5rem;
        padding-top: 0.25rem;
        background: #f7f7f7;
        text-align: center;
        box-sizing: border-box;
        border: 1px solid #d9d7d5;
        border-radius: 50px;
        -webkit-box-shadow: 3px 3px 3px rgba(0,0,0,.2);
    }
    .map-icon{
        width: 2rem !important;
        height: 2rem !important;
        vertical-align: middle;
        fill: currentColor;
        overflow: hidden;
    }
</style>