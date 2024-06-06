<template>
    <div>
    
        <navbar v-if="!navFoo" />
        <router-view />
        <footers v-if="!navFoo" />
        <!-- Back to Top -->
        <span class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></span>
    </div>
</template>

<script >
    import navbar from './navbar.vue'
    import footers from './footer.vue'
    export default {
        components: {
            navbar,
            footers
         },
        data(){
             return {
                showNavbar: false
            }
        },
        computed:{
            navFoo(){
                const routeId = this.$route.params.id;
                return this.$route.path === "/signin" || this.$route.path === "/signup" || this.$route.path === "/dashbord" || this.$route.path === "/dashbord/accuiel"  || this.$route.path === "/dashbord/categorie" || this.$route.path === "/dashbord/produit" || this.$route.path === "/dashbord/client" || this.$route.path === "/dashbord/newsletter" || this.$route.path === "/dashbord/contact" || this.$route.path === "/dashbord/role" || this.$route.path === "/dashbord/user" || this.$route.path === "/dashbord/commande" || this.$route.path === "/dashbord/partenaire" || this.$route.path === "/dashbord/produitP" || this.$route.path === "/dashbord/panier" || this.$route.path === "/dashbord/profilP" || (this.$route.path === "/dashbord/detailP/"+routeId) 
           }
        }   
    }
</script>

<style>
    
</style>