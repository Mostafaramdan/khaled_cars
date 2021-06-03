<template>
    <div>
        <b-sidebar
            id="sidebar-right"
            :title="' مرحبا ' + $store.getters.getUser.name"
            right
            shadow
            style="width: 100%"
        >
            <div class="px-3 py-2">
                <b-list-group>
                    <router-link :to="{name: 'statistics'}">
                        <b-list-group-item :active="$route.name.includes('statistics')">
                            الاحصائيات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'users'}" v-if="!$store.getters.getUser.estates_id">
                        <b-list-group-item :active="$route.name.includes('user')">
                            المستخدمين
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'housing_units'}">
                        <b-list-group-item :active="$route.name.includes('housing_units')">
                            الوحدات السكنية
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'estates'}">
                        <b-list-group-item :active="$route.name.includes('estates')" >
                            الفنادق
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'attachments'}"  v-if="!$store.getters.getUser.estates_id">
                        <b-list-group-item :active="$route.name.includes('attachments')">
                             المرافق
                        </b-list-group-item >
                    </router-link>

                    <router-link :to="{name: 'vouchers'}" >
                        <b-list-group-item :active="$route.name.includes('vouchers')" v-if="!$store.getters.getUser.estates_id">
                             أكواد الخصم
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'offers'}">
                        <b-list-group-item :active="$route.name.includes('offers')">
                             العروض
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'orders'}">
                        <b-list-group-item :active="$route.name.includes('orders')">
                             الطلبات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'countries'}"  v-if="!$store.getters.getUser.estates_id">
                        <b-list-group-item :active="$route.name.includes('countries') || $route.name.includes('cities') || $route.name.includes('districts')">
                             الدول / المدن / المناطق
                        </b-list-group-item >
                    </router-link>
                     <router-link :to="{name: 'contacts'}"  v-if="!$store.getters.getUser.estates_id">
                        <b-list-group-item :active="$route.name.includes('contacts')">
                             الشكاوي والاقتراحات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'notifications'}"  v-if="!$store.getters.getUser.estates_id">
                        <b-list-group-item :active="$route.name.includes('notifications')">
                             الاشعارات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'app_settings'}"  v-if="!$store.getters.getUser.estates_id">
                        <b-list-group-item :active="$route.name.includes('app_settings')">
                             الاعدادات
                        </b-list-group-item >
                    </router-link>
                    <router-link :to="{name: 'admins'}"  v-if="!$store.getters.getUser.estates_id">
                        <b-list-group-item :active="$route.name.includes('admins')">
                             المسؤولين
                        </b-list-group-item >
                    </router-link>
                </b-list-group>
            </div>
        </b-sidebar>
    </div>
</template>
<script>
export default {
    data() {
        return {
            userLink: "users"
        };
    }
};
</script>
