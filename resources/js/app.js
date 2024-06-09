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
        path: "/cmdC",
        component: ()=>import('./components/cmdC.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: "/contact",
        component: ()=>import('./components/contact.vue')
    },
    {
        path: "/catProd/:id",
        component: ()=>import('./components/catProd.vue')
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
            {
                path: "commande",
                component:()=>import('./components/Admin/commande.vue'),
                name: "commande" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "partenaire",
                component:()=>import('./components/Admin/partenaire.vue'),
                name: "partenaire" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "produitP",
                component:()=>import('./components/Admin/produitP.vue'),
                name: "produitP" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "detailP/:id",
                component:()=>import('./components/Admin/detailP.vue'),
                name: "detailP" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "panier",
                component:()=>import('./components/Admin/panier.vue'),
                name: "panier" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "profilP",
                component:()=>import('./components/Admin/profilP.vue'),
                name: "profilP" ,
                meta: { requiresAuth: true, requiresRole: true}
            },
            {
                path: "cmdP",
                component:()=>import('./components/Admin/cmdP.vue'),
                name: "cmdP" ,
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