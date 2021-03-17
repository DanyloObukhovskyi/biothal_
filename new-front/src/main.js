import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from "./router";
import "./plugins/vue-the-mask";
import globalMixins from "./mixins/global"
import store from './store/index';

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
