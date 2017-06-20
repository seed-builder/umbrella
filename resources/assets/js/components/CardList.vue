<template>
    <div class="pull-to-refresh-content" :id="options.refreshId" data-ptr-distance="20">
        <div class="content infinite-scroll infinite-scroll-bottom"
             :id="options.scrollId">
            <div class="pull-to-refresh-layer">
                <div class="preloader"></div>
                <div class="pull-to-refresh-arrow"></div>
            </div>
            <div class="card-container">
                <div class="card"
                     :class="{'csx-link':options.itemUrl} "
                     :data-url="options.itemUrl?options.itemUrl(item):''"
                     v-for="item in items"
                >
                    <div class="card-header" v-if="options.header">{{options.header(item)}}</div>
                    <div class="card-content" @click="options.itemBtns?showBtns(item):''">
                        <div class="card-content-inner" v-for="col in options.columns">
                            <span v-if="col.value">{{col.name+'：'+itemVal(item,col.value)}}</span>
                            <span v-if="col.render">{{col.name+'：'+col.render(item)}}</span>
                        </div>
                    </div>
                    <div class="card-footer" v-if="options.footer">{{options.footer(item)}}</div>
                </div>


            </div>
            <div v-if="loading" class="infinite-scroll-preloader">
                <div class="preloader"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.init()
        },
        created: function () {

        },
        props: {
            'options': {
                header: {
                    type: Function
                },
                footer: {
                    type: Function
                },
                columns: {
                    type: Array
                },

            },

        },
        data() {
            return {
                draw: 1,
                items: {},
                loading: false,
                header: function (item) {

                }
            }
        },
        methods: {
            init: function () {
                this.load();
                var self = this;
                self.initRefresh();
                self.initScroll();

            },
            initScroll : function () {
                var self = this;
                $("#"+self.options.scrollId).scroll(function () {
                    var scrollHeight = $(this)[0].scrollHeight;
                    var scrollTop = $(this)[0].scrollTop
                    var elHeight = $(this).height();
                    if (scrollHeight - (scrollTop + elHeight) < 50) {
                        if (self.loading) return;
                        self.loading = true;
                        self.load();
                    }

                    if (scrollTop==0){
                        self.initRefresh();
                    }else {
                        self.destroyRefresh();
                    }
                })
            },
            initRefresh : function () {
                var self = this;
                $.initPullToRefresh('#'+self.options.refreshId)
                $(document).on('refresh', '#'+self.options.refreshId, function (e) {
                    self.reload();
                });
            },
            destroyRefresh : function () {
                var self = this;
                $.destroyPullToRefresh('#'+self.options.refreshId)
            },
            setAjaxParams: function () {

            },
            load: function () {
                var self = this

                this.ajaxPostData(this.options.ajax, this.options.ajaxParams, function (res) {
                    self.draw++;

                    var data = $.makeArray(self.items);

                    if (data.length == 1)
                        data = res.data;
                    else
                        data = data.concat(res.data);

                    self.items = data;
                    self.loading = false;
                })
            },
            reload: function () {
                var self = this
                self.draw = 1;

                this.ajaxPostData(this.options.ajax, this.options.ajaxParams, function (res) {
                    self.draw++;
                    self.items = res.data;
                    self.loading = false;
                    $.pullToRefreshDone(self.options.refreshId);
                })
            },
            ajaxPostData: function (url, ajaxParams, successCallBack) {
                ajaxParams['_token'] = $('meta[name="_token"]').attr('content');
                ajaxParams['draw'] = this.draw;

                $.post(url, ajaxParams, function (res) {
                    if (successCallBack)
                        successCallBack(res);
                })
            },
            itemVal: function (item, val) {
                return eval('item.' + val)
            },
            showBtns: function (item) {
                var btns = [];

                for (var i = 0; i < this.options.itemBtns.length; i++) {
                    var op = this.options.itemBtns[i];
                    btns.push({
                        text: op.text,
                        onClick: function () {
                            op.clickEvent(item)
                        }
                    })
                }
                var cancel = [
                    {
                        text: '取消',
                        bg: 'danger'
                    }
                ];
                var groups = [btns, cancel];
                $.actions(groups);
            }
        }
    }
</script>
