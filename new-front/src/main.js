import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from "./router";
import "./plugins/vue-the-mask";
import globalMixins from "./mixins/global"

import '@/styles/main.scss';

Vue.config.productionTip = false

Vue.mixin(globalMixins)

new Vue({
    vuetify,
    router,
    icons: {
        iconfont: ['mdi', 'md']
    },
    render: h => h(App),
}).$mount('#app')
