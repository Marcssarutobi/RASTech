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
                                <button @click="GetProduit(getid.id)"  class="btn btn-primary px-3 w-50 btn-lg"><i class="fa fa-shopping-cart mr-1"></i> Commander</button>
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

        <!-- Modal Enrégistrement -->
            <div v-if="addModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable ">
                        <div class="modal-content"  data-aos-duration="300">
                            <div class="modal-header">
                                <h5 class="modal-title">Commander ce produits</h5>
                                <button type="button" class="btn btn-white" @click="addModal = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                            </div>
                            <div class="modal-body">
                        
                               <div class="row gx-3">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Nom du produit</label>
                                            <input type="text" name="" id="" disabled v-model="getProd.name_prod" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Superficie (m2)</label>
                                            <input type="text" name="" id="" disabled v-model="getProd.surface" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12" v-for="(input,index) in data.mesure" :key="index">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label for="">Longueur :</label>
                                                    <input type="number" name="" id="" class="form-control" v-model="input.long" step="0.01">
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                 <div class="form-group">
                                                    <label for="">largeur :</label>
                                                    <input type="number" name="" id="" class="form-control" v-model="input.larg" step="0.01" >
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mt-3">
                                                <button @click="remove(index)" v-show="index || (!index && data.mesure.length > 1)" class="btn btn-danger mr-2"> <i class="fas fa-trash"></i></button>
                                                <button @click="add(index)" v-show="index == data.mesure.length-1 " class="btn btn-success"> <i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Surface Total (m2)</label>
                                            <input type="number" name="" id="" disabled class="form-control" v-model="totalArea">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Quantité à acheter</label>
                                            <input type="number" disabled name="" id="" class="form-control" v-model="results">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Prix de Vente</label>
                                            <input type="number" disabled name="" id="" class="form-control" v-model="getProd.PVente">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Montant à Payer</label>
                                            <input type="number" disabled name="" id="" class="form-control" v-model="TotalPayer">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="addModal = false"  data-bs-dismiss="modal">Fermer</button>
                                <button type="button" class="btn btn-primary" >Enrégistrer</button>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- Fin Modal Enrégistrement -->

    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            getid: {},
            addModal: false,
            getProd: {},
            data: {
                mesure: [
                    {
                        long: "",
                        larg: ""
                    }
                ],
                Stotal: 0,
                qte: 0,
                TotalP: 0
            }
        }
    },
    computed: {
        totalArea() {
            return this.data.mesure.reduce((sum, item) => {
                return this.data.Stotal = sum + (item.long * item.larg);
            }, 0);
        },
        results() {
            return this.data.qte = this.data.Stotal / this.getProd.surface  ;
        },
        TotalPayer() {
            return this.data.TotalP = this.data.qte * this.getProd.PVente
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
        async GetProduit(id) {
            this.addModal = true
            const res = await axios.get('/getpro/' + id)
            if (res.status === 200) {
                this.getProd = res.data.prod
            }
        },
        add(index) {
            this.data.mesure.push({long:"",larg:""})
        },
        remove(index) {
            this.data.mesure.splice(index, 1)
        },
    },
    created() {
        this.GetProduits()
    }
}
</script>

<style>
    
</style>