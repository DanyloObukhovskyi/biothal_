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
        meta: {
          label: 'Для лица'
        },
        children: [
          {
            path: 'masks',
            name: 'masks',
            meta: {
              label: 'Маски'
            },
            component: {render: h => h('router-view')},
            children: [
              {
                path: ':id',
                component: () => import('../pages/Product'),
                meta: {},
                props: true
              }
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
// {
//     path: 'account-settings',
//     name: 'account-settings',
//     component: () => import('../pages/AccountSettings'),
//     meta: {}
// }
    ],
  },
  {
    path: '/404',
    name:
      '404',
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
