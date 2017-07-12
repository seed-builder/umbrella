<template>
    <div>
        <x-header :left-options="{showBack: true}">个人信息</x-header>
        <box gap="0.5rem 0.5rem">

        <group label-width="4.5em" label-margin-right="2em" label-align="left">
            <cell title="微信昵称" value="value">
            </cell>
            <x-input title='手机号' v-model="value1"></x-input>
            <selector title='性别' :options="['男', '女']" v-model="value2"></selector>
            <x-address title='地址' v-model="addressValue" raw-value :list="addressData"
                       value-text-align="left"></x-address>
        </group>

        <flexbox>
            <flexbox-item>
                <x-button type="primary">保存个人信息</x-button>
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
</style>
