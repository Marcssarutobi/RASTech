import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue'
import Pagination from 'v-pagination-3';
import { createRouter, createWebHashHistory } from 'vue-router';

const app = createApp({})

app.component('app', App)
app.component('pagination', Pagination);
const routes = [
    {
        path: "/",
        component: ()=>import('./components/accueil.vue')
    },
    {
        path: "/shop",
        component: ()=>import('./components/shop.vue')
    },
    {
        path: "/shopDetail/:id",
        component: ()=>import('./components/shopDetail.vue')
    },
    {
        path: "/panier",
        component: ()=>import('./components/panier.vue')
    },
    {
        path: "/contact",
        component: ()=>import('./components/contact.vue')
    },
    {
        path: "/signin",
        component: ()=>import('./components/signin.vue')
    },
    {
        path: "/profil",
        component: ()=>import('./components/profil.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: "/signup",
        component: ()=>import('./components/signup.vue')
    },
    {
        path: "/dashbord",
        component: ()=>import('./components/Admin/dashbord.vue'),
        children:[
            {
                path: "accuiel",
                component:()=>import('./components/Admin/accueil.vue'),
                meta: { requiresAuth: true }
            },
            {
                path: "categorie",
                component:()=>import('./components/Admin/categorie.vue'),
                meta: { requiresAuth: true }
            },
            {
                path: "produit",
                component:()=>import('./components/Admin/produit.vue'),
                meta: { requiresAuth: true }
            },
            {
                path: "client",
                component:()=>import('./components/Admin/client.vue'),
                meta: { requiresAuth: true }
            },
            {
                path: "newsletter",
                component:()=>import('./components/Admin/newsletter.vue'),
                meta: { requiresAuth: true }
            },
            {
                path: "contact",
                component:()=>import('./components/Admin/contact.vue'),
                meta: { requiresAuth: true }
            },
            {
                path: "role",
                component:()=>import('./components/Admin/role.vue'),
                meta: { requiresAuth: true }
            },
            {
                path: "user",
                component:()=>import('./components/Admin/user.vue'),
                meta: { requiresAuth: true }
            },
        ]
    },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

function requireAuth(to, from, next){
    const isAuthenticated = localStorage.getItem('token')
    if (isAuthenticated) {
        next();
    } else {
        next('/signin');
    }
}

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        requireAuth(to, from, next);
    } else {
        next()
    }
})

app.use(router)


app.mount('#app')