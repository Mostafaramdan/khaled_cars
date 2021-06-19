<template>
    <div>
        <loading :active.sync="$store.state.isLoading"
            color="blue"
            :is-full-page="true">
        </loading>
        <heading></heading>
        <slidbar></slidbar>
        <div class="m-1 overflow-hidden">
            <router-view ></router-view>
        </div>
    </div>
</template>
<script>
import slidbar from '@/components/layouts/slidbar';
import header from '@/components/layouts/header';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
    export default {
        data(){
        return {
                name : 'mostafa',
            }
        },
        methods:{
            backbutton:function(){

            }
        },
        created() {
            let store = this.$store
            window.onpopstate = function(event) {
                store.state.isLoading = false;
            };
        },
        components: {
                slidbar,'heading':header,Loading
        },
        mounted(){
        },
        updated(){

        }
    }
</script>
