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

        <div class="container-fluid">
        
            <div class="col-lg-9 col-md-8 justify-content-center">
                
                <div class="col-lg-6 col-md-6 col-sm-6 pb-1" v-for="prod in prods" :key="prod.id">
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

            </div>

        </div>

    </div>
</template>

<script>
export default {
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