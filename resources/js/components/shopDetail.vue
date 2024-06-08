<template>
    <div>
        <!-- Breadcrumb Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <router-link class="breadcrumb-item text-dark" to="/">Home</router-link>
                        <router-link class="breadcrumb-item text-dark" to="/shop">Shop</router-link>
                        <span class="breadcrumb-item active">Shop Detail</span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

         <!-- Shop Detail Start -->
        <div class="container-fluid pb-5">
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
                        
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <!-- <button :disabled="!logger" @click="addToCart(getid)" class="btn btn-primary px-3 mr-2 w-50 btn-lg"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button> -->
                            <button :disabled="!logger" @click="GetProduit(getid.id)" class="btn btn-primary px-3 mr-2 w-50 btn-lg"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                            <div class="alert-danger p-3 rounded " v-if="!logger">
                                <p class="text-center m-0">Veuillez d'abord vous connecter </p>
                            </div>
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
            <div class="row px-xl-5">
                <div class="col">
                    <div class="bg-light p-30">
                        <div class="nav nav-tabs mb-4">
                            <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                            <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-pane-1">
                                <h4 class="mb-3">Product Description</h4>
                                <p>{{ getid.description }}.</p>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-4">1 review for "Product Name"</h4>
                                        <div class="media mb-4">
                                            <img src="../../../public/img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            <div class="media-body">
                                                <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                                <div class="text-primary mb-2">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-4">Leave a review</h4>
                                        <small>Your email address will not be published. Required fields are marked *</small>
                                        <div class="d-flex my-3">
                                            <p class="mb-0 mr-2">Your Rating * :</p>
                                            <div class="text-primary">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="form-group">
                                                <label for="message">Your Review *</label>
                                                <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Your Name *</label>
                                                <input type="text" class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Your Email *</label>
                                                <input type="email" class="form-control" id="email">
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Detail End -->

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
                                <div class="col-12" v-for="(input, index) in data.mesure" :key="index">
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
                                            <button @click="add(index)" v-show="index == data.mesure.length - 1" class="btn btn-success"> <i class="fas fa-plus"></i></button>
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
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Se fais livrer ?</label>
                                        <select name="" id="" class="form-control" v-model="data.livraison">
                                            <option value="Oui">Oui</option>
                                            <option value="Non">Non</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="addModal = false"  data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary" @click="handlepaiy" >Commander</button>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Fin Modal Enrégistrement -->
    </div>
</template>

<script>
    import axios from 'axios';
    import Swal from 'sweetalert2'
    import { mapMutations } from 'vuex';
    export default{
        data(){
            return{
                getid:{},
                user:{},
                logger: false,
                addModal: false,
                getProd: {},
                userinfo:{},
                data: {
                    mesure: [
                        {
                            long: "",
                            larg: ""
                        }
                    ],
                    Stotal: 0,
                    qte: 0,
                    TotalP: 0,
                    livraison:""
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
                return this.data.qte = this.data.Stotal / this.getProd.surface;
            },
            TotalPayer() {
                return this.data.TotalP = this.data.qte * this.getProd.PVente
            }
        },
        methods:{
            async GetProduits(){
                const res = await axios.get('/getpro/'+ this.$route.params.id)
               if (res.status === 200) {
                    this.getid = res.data.prod
                    console.log(this.getid)
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
            },
            ...mapMutations(['addToCart']),
            async GetProduit(id) {
                this.addModal = true
                const res = await axios.get('/getpro/' + id)
                if (res.status === 200) {
                    this.getProd = res.data.prod
                }
            },
            add(index) {
                this.data.mesure.push({ long: "", larg: "" })
            },
            remove(index) {
                this.data.mesure.splice(index, 1)
            },
            async UserInfoCurrent() {
                try {
                    const info = await axios.get('/getuserinfo/' + this.user.id)
                    if (info.status === 200) {
                        this.userinfo = info.data.info
                        console.log(this.userinfo)
                    }
                } catch (error) {
                    console.error('Erreur ici :', error)
                }
            },
            async handlepaiy() {
                const widget = FedaPay.init({
                    public_key: 'pk_sandbox_L4pS0w5ats9iXVhDv44P3OkY',
                    transaction: {
                        amount: this.data.TotalP,
                        description: 'Acheter mon produit'
                    },
                    customer: {
                        email: this.user.email,
                        lastname: this.userinfo.nom,
                        firstname: this.userinfo.prenom
                    },
                });
                widget.open()

                const datas = {
                    user_id: this.user.id,
                    prod_id: this.getProd.id,
                    qte: this.data.qte,
                    prix: this.data.TotalP,
                    status: "New",
                    livraison: this.data.livraison
                }
                const res = await axios.post('/createCmd', datas)
                if (res.status === 200) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: "Commande enrégistrer avec succès",
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: false
                    })
                    
                }
            },
            
        },
        created(){
            this.GetProduits()
            this.UserInfoCurrent()
            this.CurrentUser()
        },
       
    }
</script>

<style>
    
</style>