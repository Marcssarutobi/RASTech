<template>
    <div>
        <!-- Topbar Start -->
        <div class="container-fluid">
            <div class="row bg-secondary py-1 px-xl-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="d-inline-flex align-items-center h-100">
                        <a class="text-body mr-3" href="">About</a>
                        <router-link class="text-body mr-3" to="/contact">Contact</router-link>
                        <a class="text-body mr-3" href="">Help</a>
                        <a class="text-body mr-3" href="">FAQs</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <router-link to="/signin" class="dropdown-item" v-if="!logger" type="button">Sign in</router-link>
                                <router-link to="/signup" class="dropdown-item" v-if="!logger" type="button">Sign up</router-link>
                                <router-link to="/profil" class="dropdown-item" v-if="logger">Profils</router-link>
                                <span style="cursor: pointer;" @click="Logout" class="dropdown-item" v-if="logger">Logout</span>
                            </div>
                        </div>
                        <div class="btn-group mx-2">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">USD</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" type="button">EUR</button>
                                <button class="dropdown-item" type="button">GBP</button>
                                <button class="dropdown-item" type="button">CAD</button>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">EN</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" type="button">FR</button>
                                <button class="dropdown-item" type="button">AR</button>
                                <button class="dropdown-item" type="button">RU</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-inline-flex align-items-center d-block d-lg-none">
                        <a href="" class="btn px-0 ml-2">
                            <i class="fas fa-heart text-dark"></i>
                            <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                        </a>
                        <a href="" class="btn px-0 ml-2">
                            <i class="fas fa-shopping-cart text-dark"></i>
                            <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
                <div class="col-lg-4">
                    <router-link to="/" class="text-decoration-none">
                        <span class="h1 text-uppercase text-primary bg-dark px-2">RAS</span>
                        <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">TECH</span>
                    </router-link>
                </div>
                <div class="col-lg-4 col-6 text-left">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for products">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent text-primary">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-6 text-right">
                    <p class="m-0">Customer Service</p>
                    <h5 class="m-0">+012 345 6789</h5>
                </div>
            </div>
        </div>
        <!-- Topbar End -->


        <!-- Navbar Start -->
        <div class="container-fluid bg-dark mb-30">
            <div class="row px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                        <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                        <i class="fa fa-angle-down text-dark"></i>
                    </a>
                    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                        <div class="navbar-nav w-100">
                            <a href="#" v-for="cat in Cats" :key="cat.id" class="nav-item nav-link">{{ cat.name_cat }}</a>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                        <router-link to="/" class="text-decoration-none d-block d-lg-none">
                            <span class="h1 text-uppercase text-dark bg-light px-2">RAS</span>
                            <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">TECH</span>
                        </router-link>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <router-link to="/" class="nav-item nav-link active">Home</router-link>
                                <router-link to="/shop" class="nav-item nav-link">Shop</router-link>
                                <!-- <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Services <i class="fa fa-angle-down mt-1"></i></a>
                                    <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                        <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                        <a href="checkout.html" class="dropdown-item">Checkout</a>
                                    </div>
                                </div> -->
                                <router-link to="/contact" class="nav-item nav-link">Contact</router-link>
                            </div>
                            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                                <router-link to="/cmdC" class="btn px-0" v-if="logger">
                                    <i class="fas fa-shop text-primary"></i>
                                </router-link>
                                <router-link to="/panier" class="btn px-0 ml-3">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">{{ cartTotal }}</span>
                                </router-link>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar End -->
    </div>
</template>

<script >
    import axios from 'axios';
    import { mapGetters } from 'vuex';
    export default{
        computed:{
            ...mapGetters(['cartTotal'])
        },
        data(){
            return{
                user: {},
                Cats: {},
                logger:false
            }
        },
        methods:{
            async Logout(){
                const res = await axios.post('/logout',null,{
                    headers:{
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                })
                localStorage.removeItem('token')
                this.$router.push("/signin")
            },
            async AllCategorie(){
                const res = await axios.get('/Categories')
                if (res.status === 200) {
                    this.Cats = res.data.categories
                }
            },
            async CurrentUser() {
                const users = await axios.get('/currentUser')
                if (users.status === 200) {
                    this.user = users.data.user
                    if (this.user) {
                        this.logger = true
                    } else {
                        this.logger = false
                    }
                }
            }
        },
        created(){
            this.CurrentUser()
            this.AllCategorie()
        }
    }
</script>

<style>
    
</style>