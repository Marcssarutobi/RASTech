<template>
    <div>
        <div class="container-fluid">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Détaille Produits</span></h2>
            <div class="row px-xl-5">
                    <div class="col-lg-5 mb-30">
                        <div class="images w-100 h-100 d-flex align-items-center justify-content-center">
                            <img class="" :src="getid.image" alt="Image" style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>

                    <div class="col-lg-7 h-auto mb-30">
                        <div class="h-100 bg-light p-30">
                            <h3 class="mb-4">{{ getid.name_prod }}</h3>
                        
                            <h3 class="font-weight-semi-bold mb-4">{{ getid.PVente }} FCFA</h3>
                            <p class="mb-4" >{{ getid.description }}</p>
                            <p class="mb-4"> Cet article sera disponible le : {{ getid.dispo }} </p>
                        
                            <div class="d-flex align-items-center mb-4 pt-2">
                                <button @click="addToCart(getid)" class="btn btn-primary px-3 mr-2 w-50 btn-lg"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                            </div>
                            <div class="d-flex pt-2">
                                <strong class="text-dark mr-2">Share on:</strong>
                                <div class="d-inline-flex">
                                    <a class="text-dark px-2" href="">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a class="text-dark px-2" href="">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a class="text-dark px-2" href="">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a class="text-dark px-2" href="">
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        

    </div>
</template>

<script>
import axios from 'axios';
import { mapMutations } from 'vuex';
export default {
    data() {
        return {
            getid: {},
        }
    },
    methods: {
        async GetProduits() {
            const res = await axios.get('/getpro/' + this.$route.params.id)
            if (res.status === 200) {
                this.getid = res.data.prod
                console.log(this.getid)
            }
        },
        ...mapMutations(['addToCart']),
    },
    created() {
        this.GetProduits()
    }
}
</script>

<style>
    
</style>