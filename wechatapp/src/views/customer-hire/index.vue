<template>
    <div>
        <card-list :options="listOptions"></card-list>
    </div>
</template>

<script>
//    import {CardList} from '../components/CardList.vue'


    export default {
        components: {
//            CardList
        },
        data () {
            return {
                listOptions: {
                    scrollId : 'hires-id'
                }
            }
        }
    }
</script>

<style scoped>

</style>