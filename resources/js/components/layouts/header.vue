<template>
    <nav class="navbar navbar-dark bg-dark mb-3" >
        <div class="container-fluid">
            <a class="navbar-brand" >
                <b-button v-b-toggle.sidebar-right variant="info" pill active v-show="checkAuth">
                    القائمة
                <i class="fas fa-bars"></i>
                </b-button>
            </a>
            <b-dropdown  text="خيارات" class="m-md-2" v-if="checkAuth">
                <b-dropdown-item>الاعدادات</b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item @click="logout">تسجيل الخروج</b-dropdown-item>
            </b-dropdown>

        </div>
    </nav>
</template>
<script>
import {  mapGetters  } from 'vuex'

export default {
    data(){
        return {
        }
    },
    methods:{
        logout(){
            this.$store.dispatch('logoutAction')
            this.$router.push({ path: '/dashboard/login' })

        }
    } ,computed: {
        ...mapGetters([
            'checkAuth'
        ])
    }
}
</script>
