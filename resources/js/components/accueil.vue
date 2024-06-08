<template>
    <div>
        

        <!-- Carousel Start -->
        <div class="container-fluid mb-3">
            <div class="row px-xl-5">
                <div class="col-lg-12">
                    <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#header-carousel" data-slide-to="1"></li>
                            <li data-target="#header-carousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item position-relative active" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="../../../public/img/car3.jpg" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Carreau Ciment</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                        <router-link class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" to="/shop">Shop Now</router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item position-relative" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="../../../public/img/car4.jpg" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Carreaux Douche</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                        <router-link class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" to="/shop">Shop Now</router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item position-relative" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="../../../public/img/car5.jpg" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Papier Peint</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                        <router-link class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" to="/shop">Shop Now</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-4">
                    <div class="product-offer mb-30" style="height: 200px;">
                        <img class="img-fluid" src="../../../public/img/offer-1.jpg" alt="">
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase">Save 20%</h6>
                            <h3 class="text-white mb-3">Special Offer</h3>
                            <a href="" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                    <div class="product-offer mb-30" style="height: 200px;">
                        <img class="img-fluid" src="../../../public/img/offer-2.jpg" alt="">
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase">Save 20%</h6>
                            <h3 class="text-white mb-3">Special Offer</h3>
                            <a href="" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- Carousel End -->

        <!-- Featured Start -->
        <div class="container-fluid pt-5">
            <div class="row px-xl-5 pb-3">
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                        <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featured End -->

        <!-- Products Start -->
        <div class="container-fluid pt-5 pb-3">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
            <div class="row px-xl-5">
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1" v-for="prod in prods" :key="prod.id">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" :src="prod.image" alt="" style="max-width: 100%; max-height: 100%; height: 330.23px; width: 100%; object-fit: cover;">
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
               
            </div>
        </div>
        <!-- Products End -->

        <!-- Offer Start -->
        <div class="container-fluid pt-5 pb-3">
            <div class="container">
                <div class="row g-3 mb-3">
                    <div class="col-lg-5">
                        <img src="../../../public/img/part.jpg" class="img-fluid rounded w-100 h-100" style="max-width: 100%;max-height: 100%;" alt="">
                    </div>
                    <div class="col-lg-7">
                        <div class="text-start">
                            <h1>Devenir partenaire ?</h1>
                        </div>
                        <p style="text-align: justify;">Plongez dans une expérience enrichissante en explorant les nombreux avantages offerts par une collaboration avec MultiShop ! En tant que partenaire privilégié, vous aurez l'opportunité exclusive d'accéder à notre gamme de produits en gros, bénéficiant ainsi de tarifs compétitifs et d'une flexibilité accrue pour répondre aux besoins de votre entreprise. Nous vous garantissons non seulement des prix avantageux, mais aussi une qualité inégalée et un service client dédié, toujours prêts à vous accompagner dans chaque étape de votre parcours.</p>
                        <router-link to="/contact" class="btn btn-primary btn-lg">Nous Contacter</router-link>
                    </div>
                </div>
            </div>
        </div>
        <!-- Offer End -->

        <!-- Products Start -->
        <div class="container-fluid pt-5 pb-3">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
            <div class="row px-xl-5">
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1" v-for="prod in prods2" :key="prod.id">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" :src="prod.image" alt="" style="max-width: 100%; max-height: 100%; height: 330.23px; width: 100%; object-fit: cover;">
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
            </div>
        </div>
        <!-- Products End -->

        


    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            prods: {},
            prods2:{}
        }
    },
    methods: {
        async AllProduits(page) {
            const res = await axios.get('/allprod?page=' + page)
            if (res.status === 200) {
                this.prods = res.data.produits.data
            }
        },
        async AllProduits2(page) {
            const res = await axios.get('/allprod?page=' + page)
            if (res.status === 200) {
                this.prods2 = res.data.produits2.data
            }
        },
    },
     created() {
        this.AllProduits()
        this.AllProduits2()
    }
}
</script>

<style>
    
</style>