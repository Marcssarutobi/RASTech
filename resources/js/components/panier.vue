<template>
    <div>
        
        <!-- Breadcrumb Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <router-link class="breadcrumb-item text-dark" to="/">Home</router-link>
                        <span class="breadcrumb-item active">Shopping Cart</span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

         <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <tr v-for="item in cartItems" :key="item.id">
                                <td class="align-middle"><img :src="item.image" alt="" style="width: 50px;"> {{ item.name_prod }}</td>
                                <td class="align-middle">{{ item.PVente }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" @click="decreaseQte(item)">
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" disabled v-model=" item.quantity ">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus" @click="increaseQte(item)">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">{{ calculateProductTotalPrice(item) }}</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger" @click="removeProductFromCart(item.id)"><i class="fa fa-times"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <form class="mb-30" action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>{{ calculateCartTotalPrice() }} FCFA</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">{{ shipping }} FCFA</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>{{ calculateTotaldu() }} FCFA</h5>
                            </div>
                            <button :disabled="logger || totaldu === 1000"  id="pay-btn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <p v-if="logger" class="alert-danger p-3 rounded text-center"> Veuillez s'il vous plait remplir vos information suplémentaire dans la section profil en cliquant sur My Acount en haut de page. </p>
            </div>
        </div>
        <!-- Cart End -->

    </div>
</template>

<script>
    import axios from 'axios';
    import Swal from 'sweetalert2'
    import { mapGetters } from 'vuex';
    import { mapMutations } from 'vuex';
    export default{
        data(){
            return {
                PrixTotal: 0,
                total: 0,
                shipping: 1000,
                totaldu: 0,
                user:{},
                userinfo:{},
                logger: false
            }
        },
        computed:{
            ...mapGetters(['cartItems','cartTotal'])
        },
        methods: {
            ...mapMutations(['removeFromCart']),
            removeProductFromCart(productId) {
                this.removeFromCart(productId);
            },
            decreaseQte(product){ // Décrementer
                if (product.quantity > 1) {
                    product.quantity--
                    product.total = product.PVente * product.quantity                 
                }
            },
            increaseQte(product){ //Incrémenter
                product.quantity++
                product.total = product.PVente * product.quantity
            },
            calculateProductTotalPrice(product) {
                return this.total = product.quantity * product.PVente;
            },
            calculateCartTotalPrice() {
                return this.PrixTotal = this.cartItems.reduce((total, product) => total + (product.quantity * product.PVente), 0);
            },
            calculateTotaldu(){
                return this.totaldu = this.shipping + this.PrixTotal
            },
            async CurrentUser(){
                const users = await axios.get('/currentUser')
                if (users.status === 200) {
                    this.user = users.data.user
                }
            },
            handlePayment(){
                
                FedaPay.init({
                    public_key:'pk_live_M-SDNE-3VYAjsTK6fx6EgfLm',
                    payment:{
                        amount: this.totaldu,
                        currency: 'XOF'
                    },
                    customer:{
                        email: this.user.email
                    },
                    onSuccess: async (transaction)=>{
                        console.log('Payment successful', transaction);
                    },
                    onError: (error) => {
                        console.error('Payment failed', error);
                    },
                })
                
            },
            async ValideAchat(){
                const response = await Promise.all(
                    this.cartItems.map(async (prod)=>{
                        const venteData = {
                            user_id : this.userinfo.id,
                            prod_id : prod.id,
                            qte : prod.quantity,
                            prix : prod.PVente * prod.quantity
                        }
                        const res = await axios.post('/createCmd',venteData)
                        if (res.status === 200) {
                            console.log("Commande enrégistrer avec succès")
                        }
                        return res
                    })
                )
                const success = response.every((res)=> res.status === 200)
                if (success) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: "Commande enrégistrer avec succès",
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: false
                    })

                    this.cartItems = []
                }
            }
            
        },
        created(){
            this.CurrentUser()
        },
       async mounted(){
            const users = await axios.get('/currentUser')
            if (users.status === 200) {
                this.user = users.data.user
                const info = await axios.get('/getuserinfo/'+this.user.id)
                if (info.status === 200) {
                    this.userinfo = info.data.userCurrent
                    if (this.userinfo == null) {
                        this.logger = true
                    }else{
                        this.logger = false
                    }
                }
            }

            const fpInstance = FedaPay.init('#pay-btn',{
                public_key:'pk_sandbox_L4pS0w5ats9iXVhDv44P3OkY',
                transaction:{
                    amount: this.totaldu,
                    description: 'Acheter mon produit'
                },
                customer:{
                    email: this.user.email,
                    lastname:this.userinfo.nom,
                    firstname: this.userinfo.prenom
                },
            })
            
        }

    }
</script>

<style>
    
</style>