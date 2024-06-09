<template>
    <div>

        <!-- Breadcrumb Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <router-link class="breadcrumb-item text-dark" to="/">Home</router-link>
                        <span class="breadcrumb-item active">{{ catId.name_cat }}</span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <div class="container-fluid">
            
            <div class="container">
                <!-- Shop Product Start -->
                <div class="col-lg-12">
                    <div class="row pb-3">
                    
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" v-for="prod in allProdCat" :key="prod.id">
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
                                    <router-link class="h6 text-decoration-none text-truncate" :to="'/shopDetail/' + prod.id">{{ prod.name_prod }}</router-link>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ prod.PVente }} FCFA</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <paginate
                            :page-count="totalPage"
                            :click-handler="AllProdCat"
                            :prev-text="'Prev'"
                            :next-text="'Next'"
                            :container-class="'pagination justify-content-center'"
                            :page-class="'page-item'"
                            >
                            </paginate>
                        </div>
                    </div>
                </div>
                <!-- Shop Product End -->
            </div>

        </div>

    </div>
</template>

<script>
    import axios from 'axios'
    import Paginate from "vuejs-paginate-next";

export default {
        components: {
            Paginate
        },
        data() {
            return {
                catId: {},
                allProdCat: {},
                currentPage: 1,
                totalPage: 0,
            }
        },
        methods: {
            async GetCat() {
                const res = await axios.get('/getcat/' + this.$route.params.id)
                if (res.status === 200) {
                    this.catId = res.data.cat
                }
            },
            async AllProdCat() {
                const res = await axios.get('/prodcat/' + this.$route.params.id)
                if (res.status === 200) {
                    this.allProdCat = res.data.prodCat.data
                    this.currentPage = res.data.prodCat.current_page
                    this.totalPage = res.data.prodCat.last_page
                    console.log(this.allProdCat)
                }
            }
        },
        created() {
            this.GetCat()
            this.AllProdCat()
        }
    }
</script>

<style>

</style>