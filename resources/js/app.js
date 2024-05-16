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
        component: ()=>import('./components/profil.vue')
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
                component:()=>import('./components/Admin/accueil.vue')
            },
            {
                path: "categorie",
                component:()=>import('./components/Admin/categorie.vue')
            },
            {
                path: "produit",
                component:()=>import('./components/Admin/produit.vue')
            },
            {
                path: "client",
                component:()=>import('./components/Admin/client.vue')
            },
        ]
    },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

app.use(router)


app.mount('#app')