const routes = [
    {
        path: '',
        name: 'dashboard',
        redirect: {name: 'home'},
        component: () => import('../pages/Dashboard'),
        children: [
            {
                path: 'home',
                name: 'home',
                component: () => import('../pages/Home'),
                meta: {}
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
            // }
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

export default routes
