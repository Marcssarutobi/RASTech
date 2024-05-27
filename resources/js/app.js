import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue'
import Pagination from 'v-pagination-3';
import { createRouter, createWebHashHistory } from 'vue-router';

import store from './components/store';

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
        component: ()=>import('./components/panier.vue'),
        meta: { requiresAuth: true }
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
                name: "accuiel" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "categorie",
                component:()=>import('./components/Admin/categorie.vue'),
                name: "categorie" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "produit",
                component:()=>import('./components/Admin/produit.vue'),
                name: "produit" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "client",
                component:()=>import('./components/Admin/client.vue'),
                name: "client" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "newsletter",
                component:()=>import('./components/Admin/newsletter.vue'),
                name: "newsletter" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "contact",
                component:()=>import('./components/Admin/contact.vue'),
                name: "contact" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "role",
                component:()=>import('./components/Admin/role.vue'),
                name: "role" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "user",
                component:()=>import('./components/Admin/user.vue'),
                name: "user" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
        ]
    },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

async function requireAuth(to, from, next){

    const res = await fetch('/authUserVerify')
    if (res.status === 200) {
        const data = await res.json()
        if (data.connect) {
            const role = localStorage.getItem('role');
            if (to.meta.requiresRole) {
                if (role === 'client' || role === 'Client') {
                    next('/');
                } else {
                    next();
                }
            } else {
                next();
            }
        }else{
            next('/signin');
        }
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
app.use(store)


app.mount('#app')