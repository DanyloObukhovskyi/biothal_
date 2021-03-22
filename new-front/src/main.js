import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from "./router";
import "./plugins/vue-the-mask";
import globalMixins from "./mixins/global"
import store from './store/index';
import axios from 'axios';
import vue_axios from 'vue-axios';

axios.defaults.baseURL = process.env.VUE_APP_REQUEST_BASE_URL + process.env.VUE_APP_REQUEST_PREFIX;
debugger
axios.defaults.headers = {
    'Content-Type': 'application/json;',
    Accept: '*/*'
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
                    alert("session expired");
                    break;
                case 403:
                    router.replace({
                        path: "/login",
                        query: { redirect: router.currentRoute.fullPath }
                    });
                    break;
                case 404:
                    alert('page not exist');
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


Vue.use(vue_axios, axios);

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
