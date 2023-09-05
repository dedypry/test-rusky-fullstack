export default [
    { path: '/', redirect: '/dashboard' },
    {
        path: '/',
        component: () => import('../components/layouts/admin/Default.vue'),
        children: [
            {
                path: 'dashboard',
                name: 'dashboard',
                component: () => import('../views/dashboard/index.vue')
            },
            {
                path: 'book',
                name: 'book',
                component: () => import('../views/book/index.vue')
            },
            {
                path: 'book/create',
                name: 'book-create',
                component: () => import('../views/book/create.vue')
            },
            {
                path: 'book/:id',
                name: 'book-detail',
                component: () => import('../views/book/detail.vue')
            },
            {
                path: 'book/edit/:id',
                name: 'book-edit',
                component: () => import('../views/book/edit.vue')
            },
        ],
        meta: {
            authOnly: true
        }
    },
    {
        path: '/',
        component: () => import('../components/layouts/auth/Default.vue'),
        children: [
            {
                path: 'login',
                name: 'login',
                component: () => import('../views/auth/login/index.vue'),
                meta: {
                    guestOnly: true
                }
            },
            {
                path: '/:pathMatch(.*)*',
                component: () => import('../views/error/404.vue'),
            }
        ]
    }
]
