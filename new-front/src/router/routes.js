import global from "../mixins/global";
const isMobile = global.computed.isMobile()

const routes = [
    {
        path: '',
        name: 'dashboard',
        redirect: {name: 'home'},
        component: () => import('../pages/Dashboard'),
        meta: {
            label: 'Главная страница'
        },
        children: [
            {
                path: 'home',
                name: 'home',
                component: () => import('../pages/Home')
            },
            {
                path: 'for-face',
                name: 'for-face',
                component: () => import('../pages/ForFace'),
                meta: {
                    label: 'Для лица'
                },
                children: [
                    {
                        path: 'masks',
                        name: 'masks',
                        component: {render: h => h('router-view')},
                        meta: {
                            label: 'Маски'
                        },
                        children: [
                            {
                                path: 'product/:id',
                                component: () => {
                                    return isMobile ? import('../pages/mobile/ProductMobile') : import('../pages/desktop/ProductDesktop')
                                },
                                meta: {},
                                props: true
                            },
                        ]
                    }
                ]
            },
            {
                path: 'checkout',
                name: 'checkout',
                component: () => import('../pages/Checkout'),
                meta: {}
            },
            {
                path: 'account-settings',
                name: 'account-settings',
                component: () => import('../pages/AccountSettings'),
                meta: {}
            },
            {
                path: 'favorites',
                name: 'favorites',
                component: () => import('../pages/Favorites'),
                meta: {}
            },
            {
                path: 'about-us',
                name: 'about-us',
                component: () => import('../pages/AboutUs'),
                meta: {}
            },
            {
                path: 'become-distributor',
                name: 'become-distributor',
                component: () => import('../pages/BecomeDistributor'),
                meta: {}
            },
            {
                path: 'product/:id',
                name: 'product',
                component: () => {
                    return isMobile ? import('../pages/mobile/ProductMobile') : import('../pages/desktop/ProductDesktop')
                },
                meta: {},
                props: true
            },
            {
                path: 'ordering',
                name: 'ordering',
                component: () => {
                    return isMobile ? import('../pages/mobile/OrderingMobile') : import('../pages/desktop/OrderingDesktop')
                },
                meta: {}
            },
            {
                path: 'production',
                name: 'production',
                component: () => import('../pages/Production'),
                meta: {}
            },
            {
                path: 'philosophy',
                name: 'philosophy',
                component: () => import('../pages/Philosophy'),
                meta: {}
            },
            {
                path: 'sea',
                name: 'sea',
                component: () => import('../pages/Sea'),
                meta: {}
            },
            {
                path: 'seaweed',
                name: 'seaweed',
                component: () => import('../pages/Seaweed'),
                meta: {}
            },
            {
                path: 'category-page/:category',
                name: 'category-page',
                component: () => import('../pages/CategoryPage'),
                children: [{
                    path: ':subCategory',
                    name: 'sub-category-page',
                    component: () => import('../pages/CategoryPage'),
                    meta: {},
                    prop: true
                }],
                meta: {}
            },
            {
                path: 'authorization',
                name: 'authorization',
                component: () => import('../pages/mobile/AuthorizationMobile'),
                meta: {}
            }
        ]
    },
    {
        path: '/404',
        name: '404',
        component: () => import('../pages/NotFound'),
        meta: {}
    },
    {
        path: '*',
        redirect: '/404',
        meta: {}
    }
]

export default routes
