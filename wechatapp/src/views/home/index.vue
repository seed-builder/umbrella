<template>
    <div>
        <x-header :left-options="{showBack: true}">demo</x-header>
        <group>
            <cell title="个人资料" is-link link="/customer/index">
                <i slot="icon" class="iconfont icon-gerenziliao"></i>
            </cell>
            <cell title="我的钱包" is-link>
                <i slot="icon" class="iconfont icon-qianbao3"></i>
            </cell>
            <cell title="资金纪录" is-link link="/hire-list">
                <i slot="icon" class="iconfont icon-dingdan"></i>
            </cell>
            <cell title="用伞纪录" is-link>
                <i slot="icon" class="iconfont icon-dingdan"></i>
            </cell>

        </group>
    </div>
</template>

<script>
    import {Group, Cell, XHeader} from 'vux'

    export default {
        components: {
            Group,
            Cell,
            XHeader
        },
        data () {
            return {}
        }
    }
</script>

<style scoped>
    .iconfont {
        display: block;
        margin-right: 5px;
    }
</style>