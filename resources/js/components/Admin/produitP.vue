<template>
    <div>
        
        <div class="headers mb-3">
            <i class="fas fa-cubes text-primary bg-dark"></i>
            <span class="headers_title">Produits</span>
        </div>

        <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4">
            <div></div>
            <div class="search w-25">
                <input type="search" class="form-control " placeholder="Rechercher un produits ..." name="" id="">
            </div>
        </div>

        <div class="container-fluid mb-4">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
            <div class="col-lg-11 col-md-10 mx-auto  ">
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
                                <router-link class="h6 text-decoration-none text-truncate" :to="'/dashbord/detailP/'+prod.id">{{ prod.name_prod }}</router-link>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ prod.PVente }} FCFA</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 justify-content-center p-4">
                    <paginate
                    :page-count="totalPage"
                    :click-handler="AllProduits"
                    :prev-text="'Prev'"
                    :next-text="'Next'"
                    :container-class="'pagination justify-content-center '"
                    :page-class="'page-item'"
                    >
                    </paginate>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
import axios from 'axios';
import Paginate from "vuejs-paginate-next";
export default {
    components: {
        Paginate
    },
    data() {
        return {
            prods: {},
            currentPage: 1,
            totalPage: 0,
        }
    },
    methods: {
        async AllProduits(page) {
            const res = await axios.get('/allprod?page=' + page)
            if (res.status === 200) {
                this.prods = res.data.prodP.data
                this.currentPage = res.data.prodP.current_page
                this.totalPage = res.data.prodP.last_page
            }
        },
    },
    created() {
        this.AllProduits()
    }
}
</script>

<style>
    
</style>