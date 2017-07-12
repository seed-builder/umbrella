<template>
    <div>
        <x-header :left-options="{showBack: true}">个人信息</x-header>
        <box gap="0.5rem 0.5rem">

        <group label-width="4.5em" label-margin-right="2em" label-align="left">
            <cell title="微信昵称" value="value">
                <i slot="icon" class="iconfont icon-weixin"></i>
            </cell>
            <cell title="手机号" value="value">
                <i slot="icon" class="iconfont icon-shouji"></i>
            </cell>
            <cell title="性别" value="value">
                <i slot="icon" class="iconfont icon-xingbie"></i>
            </cell>
            <cell title="地址" value="value">
                <i slot="icon" class="iconfont icon-dizhi"></i>
            </cell>
        </group>

        <flexbox>
            <flexbox-item>
                <x-button type="primary" link="/customer/edit">完善个人信息</x-button>
            </flexbox-item>
        </flexbox>
        </box>
    </div>
</template>

<script>
    import {
        Group,
        Box,
        Cell,
        XInput,
        Selector,
        ChinaAddressData,
        XAddress,
        XButton,
        XHeader,
        Flexbox,
        FlexboxItem
    } from 'vux'

    export default {
        components: {
            Group,
            Box,
            Cell,
            XInput,
            Selector,
            ChinaAddressData,
            XAddress,
            XButton,
            XHeader,
            Flexbox,
            FlexboxItem
        },
        data () {
            return {
                addressData: ChinaAddressData,
            }
        }
    }
</script>

<style scoped>
    .vux-flexbox {
        margin-top: 2rem;
    }
    .iconfont {
        margin-right: 1rem;
    }
</style>
