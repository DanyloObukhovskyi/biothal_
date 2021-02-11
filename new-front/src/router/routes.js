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
                                    return this.isMobile ? import('../pages/mobile/ProductMobile') : import('../pages/desktop/Product')
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
                path: 'effective-sets',
                name: 'effective-sets',
                component: () => import('../pages/EffectiveSets'),
                meta: {}
            },
            {
                path: 'for-body',
                name: 'for-body',
                component: () => import('../pages/ForBody'),
                meta: {}
            },
            {
                path: 'for-face',
                name: 'for-face',
                component: () => import('../pages/ForFace'),
                meta: {}
            },
            {
                path: 'product/:id',
                name: 'product',
                component: () => {
                    return import('../pages/mobile/ProductMobile')
                    // return this.isMobile ? import('../pages/mobile/ProductMobile') : import('../pages/desktop/Product')
                },
                // component: () => import('../pages/desktop/Product'),
                meta: {},
                props: true
            },
            {
                path: 'ordering',
                name: 'ordering',
                component: () => import('../pages/Ordering'),
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
        ],
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
