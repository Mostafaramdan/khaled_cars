import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import routes from '@/routes'
import mainapp from '@/components/mainapp';
import helper from '@/mixins/helper';
import api from '@/mixins/api';
import stores from '@/store/account'
import Vuex from 'vuex'
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueMeta from 'vue-meta'
import VueUploadMultipleImage from 'vue-upload-multiple-image'
import VueEasyLightbox from 'vue-easy-lightbox'
import VueSwal from 'vue-swal'
import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyByYh0lGbV5SvW1Q8FhHJCU5jMdktuXI3Y',
      libraries: 'places', // This is required if you use the Autocomplete plugin
      // OR: libraries: 'places,drawing'
      // OR: libraries: 'places,drawing,visualization'
      // (as you require)

      //// If you want to set the version, you can do so:
      // v: '3.26',
    },
})


Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);
Vue.use(VueAxios, axios);
Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(VueMeta)
Vue.use(VueUploadMultipleImage)
Vue.use(VueSwal)

Vue.use(VueEasyLightbox)
Vue.component(VueEasyLightbox.name, VueEasyLightbox)

const store = new Vuex.Store(stores);
const router = new VueRouter({
    mode: 'history',
    routes
});


router.beforeEach((to, from, next) => {
    store.state.isLoading=true
    let isAuthenticated =  store.getters.getUser.apiToken;
    if(to.name  == 'login' && isAuthenticated ){
        next({ name: 'statistics' })
    }
    if (to.name !== 'login' && !isAuthenticated)
        next({ name: 'login' })
    else
        next(true);
})

Vue.mixin(helper)
Vue.mixin(api)

function patchRouterMethod (router, methodName)
{
    router['old' + methodName] = router[methodName]
    router[methodName] = async function (location)
    {
        return router['old' + methodName](location).catch((error) =>
        {
            if (error.name === 'NavigationDuplicated')
            {
                return this.currentRoute
            }
            throw error
        })
    }
}

patchRouterMethod(router, 'push')
patchRouterMethod(router, 'replace')
new Vue({
    el: '#mainapp',
    router,
    store,
    mixins: [helper,api],
    components: {
        'main-app' : mainapp,
    },
})
