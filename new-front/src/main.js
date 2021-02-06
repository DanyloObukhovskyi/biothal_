import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from "./router";

import '@/styles/main.scss';

Vue.config.productionTip = false

new Vue({
    vuetify,
    router,
    icons: {
        iconfont: ['mdi', 'md']
    },
    render: h => h(App),
}).$mount('#app')
