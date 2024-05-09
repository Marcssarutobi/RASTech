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
                return this.$route.path === "/signin" || this.$route.path === "/signup" || this.$route.path === "/dashbord" || this.$route.path === "/dashbord/accuiel"  || this.$route.path === "/dashbord/categorie" || this.$route.path === "/dashbord/produit"
           }
        }   
    }
</script>

<style>
    
</style>