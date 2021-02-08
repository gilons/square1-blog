
import VueRouter from 'vue-router';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import(/** /app/main */ './views/home/index.vue'),
            props: true,

        },
        {
            path: '/home',
            component: () => import(/** */ './views/home/DashBoard.vue'),
            children: [
                {
                    name: 'home-dash',
                    path: '',
                    component: () => import(/** /app/main */ './views/home/index.vue'),
                },
                {
                    path: 'my-posts',
                    name: 'my-posts',
                    component: () => import(/** */ './views/my-posts/index.vue'),
                },
                {
                    path: 'add-post',
                    name: 'add-post',
                    component: () => import(/** */ './views/post/Add.vue')
                },
            ]

        },
        {
            name: 'posts.item',
            path: '/post/:slug',
            component: () => import(/** /app/main */ './views/post/index.vue')
        }
    ]
})

export default router