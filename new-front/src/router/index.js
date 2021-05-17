import Vue from 'vue';
import VueRouter from "vue-router";

import routes from './routes'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: routes,
    mode: 'history',
    scrollBehavior(to, from, savedPosition) {
        return {x: 0, y: 0}
    }
})
const originalPush = VueRouter.prototype.push
VueRouter.prototype.push = function push(location) {
    return originalPush.call(this, location).catch(err => console.log(err))
}

export default router
