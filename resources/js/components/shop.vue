<template>
    <div>
        <!-- Breadcrumb Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <router-link class="breadcrumb-item text-dark" to="/">Home</router-link>
                        <span class="breadcrumb-item active">Shop List</span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Shop Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <!-- Shop Sidebar Start -->
                <div class="col-lg-3 col-md-4">
                    <!-- Price Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <form>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" checked id="price-all">
                                <label class="custom-control-label" for="price-all">All Price</label>
                                <span class="badge border font-weight-normal">1000</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="price-1">
                                <label class="custom-control-label" for="price-1">$0 - $100</label>
                                <span class="badge border font-weight-normal">150</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="price-2">
                                <label class="custom-control-label" for="price-2">$100 - $200</label>
                                <span class="badge border font-weight-normal">295</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="price-3">
                                <label class="custom-control-label" for="price-3">$200 - $300</label>
                                <span class="badge border font-weight-normal">246</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="price-4">
                                <label class="custom-control-label" for="price-4">$300 - $400</label>
                                <span class="badge border font-weight-normal">145</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                <input type="checkbox" class="custom-control-input" id="price-5">
                                <label class="custom-control-label" for="price-5">$400 - $500</label>
                                <span class="badge border font-weight-normal">168</span>
                            </div>
                        </form>
                    </div>
                    <!-- Price End -->
                
                </div>
                <!-- Shop Sidebar End -->


                <!-- Shop Product Start -->
                <div class="col-lg-9 col-md-8">
                    <div class="row pb-3">
                        
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" v-for="prod in prods" :key="prod.id">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid" :src="prod.image" alt="" style="max-width: 100%; max-height: 100%; height: 330.23px; width: 100%; object-fit: cover;">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <router-link class="h6 text-decoration-none text-truncate" :to="'/shopDetail/'+prod.id">{{ prod.name_prod }}</router-link>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ prod.PVente }} FCFA</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <nav>
                              <ul class="pagination justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#"> Previous </a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
        <!-- Shop End -->
    </div>
</template>

<script>
    import axios from 'axios';
    export default{
        data(){
            return{
                prods:{},
                currentPage: 1,
                totalPage: 0,
                user:{},
                logger:false
            }
        },
        methods:{
            async AllProduits(page){
                const res = await axios.get('/allprod?page='+page)
                if (res.status === 200) {
                    this.prods = res.data.produits.data
                    this.currentPage = res.data.produits.current_page
                    this.totalPage = res.data.produits.last_page
                }
            },
            async CurrentUser(){
                const users = await axios.get('/currentUser')
            if (users.status === 200) {
                this.user = users.data.user
                if (this.user) {
                    this.logger = true
                }else{
                    this.logger = false
                }
            }
            }
        },
        created(){
            this.AllProduits()
            this.CurrentUser()
        }
    }
</script>

<style>
    
</style>