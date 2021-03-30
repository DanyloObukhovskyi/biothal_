import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from "./router";
import "./plugins/vue-the-mask";
import globalMixins from "./mixins/global"
import store from './store/index';
import axios from 'axios';
import vue_axios from 'vue-axios';
import VueAgile from 'vue-agile';
import Notification from 'vue-notification';
import VueLodash from 'vue-lodash';
import lodash from 'lodash';
import VueLoading from 'vuejs-loading-plugin';
import VueMeta from 'vue-meta';

axios.defaults.baseURL = process.env.VUE_APP_REQUEST_BASE_URL + process.env.VUE_APP_REQUEST_PREFIX;

axios.defaults.headers = {
    'Content-Type': 'application/json;',
    Accept: 'application/json, */*'
}

axios.interceptors.request.use(config =>{
    config.headers['Content-Type'] = 'application/json'

    return config;
})



axios.interceptors.response.use(
    response => {
        return Promise.resolve(response)
    },
    error => {
        if (error.response.status) {
            switch (error.response.status) {
                case 400:

                    //do something
                    break;

                case 401:
                    this.$store.commit("SET_TOKEN", null);
                    break;
                case 403:
                    // router.replace({
                    //     path: "/login",
                    //     query: { redirect: router.currentRoute.fullPath }
                    // });
                    break;
                case 404:
                    break;
                case 502:
                    setTimeout(() => {
                        router.replace({
                            path: "/login",
                            query: {
                                redirect: router.currentRoute.fullPath
                            }
                        });
                    }, 1000);
            }

            return Promise.reject(error.response);
        }
    }
);

Vue.use(VueMeta)
Vue.use(VueAgile)
Vue.use(vue_axios, axios);
Vue.use(Notification);
Vue.use(VueLodash, { lodash: lodash });
Vue.use(VueLoading, {
    dark: true, // default false
    text: 'Загрузка....', // default 'Loading'
    loading: false, // default false
    background: 'rgb(255,255,255)', // set custom background
    classes: ['loader_opacity'] // array, object or string
})

import '@/styles/main.scss';

Vue.config.productionTip = false

Vue.mixin(globalMixins)

router.beforeEach((to, from, next) => {
    const token = store.getters.getToken;
    if (['authorization', 'registration'].includes(to.name) && token) {
        next({name: 'account-settings'})
    } else if (['account-settings', 'order-list', 'group-discount-participants', 'bank-cards'].includes(to.name) && !token) {
        next({name: 'authorization'})
    } else {
        next()
    }
})

new Vue({
    vuetify,
    store,
    router,
    icons: {
        iconfont: ['mdi', 'md']
    },
    render: h => h(App),
}).$mount('#app')

