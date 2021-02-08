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
                path: 'face',
                name: 'face',
                component: {render: h => h('router-view')},
                // meta: {
                //   label: 'Для лица'
                // },
                children: [
                    {
                        path: 'masks',
                        name: 'masks',
                        meta: {
                            label: 'Маски'
                        },
                    },
                    {
                        path: 'product/:id',
                        name: 'product',
                        component: () => import('../pages/Product'),
                        meta: {},
                        props: true
                    },
                    {
                        path: 'checkout',
                        name: 'checkout',
                        component: () => import('../pages/Checkout'),
                        meta: {}
                    },
                    // {
                    //     path: 'account-settings',
                    //     name: 'account-settings',
                    //     component: () => import('../pages/AccountSettings'),
                    //     meta: {}
                    // },
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
                        path: 'ordering',
                        name: 'ordering',
                        component: () => import('../pages/Ordering'),
                        meta: {}
                    },
                ],
                meta: {}
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
    }
]

export default routes
