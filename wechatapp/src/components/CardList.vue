<template>
    <scroller lock-x @on-scroll-bottom="onScrollBottom" ref="scrollerBottom" :scroll-bottom-offst="0">

        <div>
            <card v-for="index in bottomCount" :header="{title:'商品详情'}"
                  :footer="{title:'查看更多',link:'/component/panel'}">
                <p slot="content" class="card-padding">custom content{{index}}</p>
                <load-more v-if="onFetching" tip="loading"></load-more>
            </card>
            <divider v-if="dataLen==0&&draw>1">没有更多数据</divider>
        </div>
    </scroller>

</template>

<script>

    import {Card, LoadMore, Scroller,Divider} from 'vux'

    export default {
        components: {
            Card,
            LoadMore,
            Scroller,
            Divider
        },
        props: {
            options: Object,
        },
        data () {
            return {
                loading: false,
                bottomCount: 10,
                onFetching: false,
                draw : 1,
                dataLen : 0,
            }
        },
        mounted() {
            console.log(http_url)
        },
        methods: {
            onScrollBottom: function () {
                if (this.onFetching) {
                    console.log('loading')
                } else {
                    this.onFetching = true
                    this.bottomCount += 10
                    //ajax
                    this.$refs.scrollerBottom.reset()

                    this.onFetching = false
                }
            },
            load : function () {
                var self = this;
                this.httpPost(this.options.ajax,this.options.params,function (res) {
                    self.dataLen == res.length;
                    self.draw++;
                })
            },
            httpPost : function (url,params,callback) {
                $.post(url, params, function (res) {
                    if (callback)
                        callback(res);
                })
            }
        }
    }
</script>

<style scoped lang="less">
    @import '~vux/src/styles/1px.less';

    .card-demo-flex {
        display: flex;
    }

    .card-demo-content01 {
        padding: 10px 0;
    }

    .card-padding {
        padding: 15px;
    }

    .card-demo-flex > div {
        flex: 1;
        text-align: center;
        font-size: 12px;
    }

    .card-demo-flex span {
        color: #f74c31;
    }


</style>