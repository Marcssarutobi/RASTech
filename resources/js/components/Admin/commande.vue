<template>
  <div>
    
    <div class="headers mb-3">
        <i class="fas fa-bag-shopping text-primary bg-dark"></i>
        <span class="headers_title">Commande</span>
    </div>

    <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4">
        <div></div>
        <div class="search ">
            <input type="search" class="form-control" placeholder="Rechercher ..." name="" id="">
        </div>
    </div>

    <div class="tableau">

        <table class="table table-striped mb-3">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nom Complet</th>
                    <th scope="col">Nom du produits</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix Total (FCFA)</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cmd in allcmd" :key="cmd.id">
                    <td :style="cmd.status === 'New'?'font-weight: 600;':''">{{ GetUserName(cmd.user_id) || GetUtiliName(cmd.user_id) }}</td>
                    <td :style="cmd.status === 'New'?'font-weight: 600;':''">{{ GetProdName(cmd.prod_id) }}</td>
                    <td :style="cmd.status === 'New'?'font-weight: 600;':''">{{ cmd.qte }}</td>
                    <td :style="cmd.status === 'New'?'font-weight: 600;':''">{{ cmd.prix }} FCFA</td>
                    <td :style="cmd.status === 'New'?'font-weight: 600;':''">{{ cmd.status }}</td>
                    <td>
                        <button class="btn btn-primary mr-3" @click="GetCMD(cmd.id)" ><i class="fas fa-eye"></i></button>
                        <button class="btn btn-danger" v-if="cmd.status === 'Livré'" @click="DelCMD(cmd.id)" ><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

    <!-- Modal Enrégistrement -->
        <div v-if="addModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
            <div class="modal-dialog modal-dialog-centered modal-lg ">
                <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                    <div class="modal-header">
                        <h5 class="modal-title">Commande reçu</h5>
                        <button type="button" class="btn btn-white" @click="addModal = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                    </div>
                    <div class="modal-body">

                        <div class="row gx-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <h4>Client : <span>{{ GetUserName(getcmd.user_id) || GetUtiliName(getcmd.user_id) }}</span></h4>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h6>Adresse : <span>{{ GetUseradress(getcmd.user_id) || GetUtiliadress(getcmd.user_id) }}</span></h6>
                                <h6>Téléphone : <span>{{ GetUserphone(getcmd.user_id) || GetUtiliphone(getcmd.user_id) }}</span></h6>
                            </div>
                        </div>

                        <table class="table table-striped mb-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nom du produits</th>
                                    <th>Quantiter</th>
                                    <th>Total payer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ GetProdName(getcmd.prod_id) }}</td>
                                    <td>{{ getcmd.qte }}</td>
                                    <td>{{ getcmd.prix }} FCFA</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex align-items-center justify-content-between">
                            <div></div>
                            <h5 class="mr-4 alert  rounded rounded-3" :class="getcmd.status === 'New' ? 'alert-danger': getcmd.status === 'En Cours' ? 'alert-warning': getcmd.status === 'Livré' ? 'alert-success' : ''">{{ getcmd.status }}</h5>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="addModal = false"  data-bs-dismiss="modal">Fermer</button>
                        <button type="button" v-if="getcmd.status === 'New'" class="btn btn-primary" @click="ValideCMD" >Validé</button>
                        <button type="button" v-if="getcmd.status === 'En Cours'" class="btn btn-primary" @click="LivrerCMD" >Livré</button>
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
export default {
    data(){
        return{
            allcmd:{},
            alluser: {},
            allprod:{},
            addModal: false,
            getcmd: {},
            allutili:{}
        }
    },
    methods:{
        async AllCmds(){
            const res = await axios.get('/allcmd')
            if (res.status === 200) {
                this.allcmd = res.data.cmds
                console.log(this.allcmd)
            }
        },
        async AllUser(){
            const res = await axios.get('/alluserinfo')
            if (res.status === 200) {
                this.alluser = res.data.users
            }
        },
        async AllUtili() {
            const res = await axios.get('/allutili')
            if (res.status === 200) {
                this.allutili = res.data.alluser
            }
        },
        GetUserName(id) {
            const userInfo = this.alluser.find(user => user.user_id=== id)
            return userInfo ? userInfo.nom +" "+ userInfo.prenom : ""
        },
         GetUseradress(id) {
            const userInfo = this.alluser.find(user => user.user_id === id)
            return userInfo ? userInfo.ville + " , " + userInfo.quartier : ""
        },
         GetUserphone(id) {
            const userInfo = this.alluser.find(user => user.user_id === id)
            return userInfo ? userInfo.phone  : ""
        },
        GetUtiliName(id) {
            const userInfo = this.allutili.find(user => user.user_id === id)
            return userInfo ? userInfo.nom + " " + userInfo.prenom : ""
        },
        GetUtiliadress(id) {
            const userInfo = this.allutili.find(user => user.user_id === id)
            return userInfo ? userInfo.ville + " , " + userInfo.quartier : ""
        },
        GetUtiliphone(id) {
            const userInfo = this.allutili.find(user => user.user_id === id)
            return userInfo ? userInfo.phone  : ""
        },
        async AllProduit() {
            const res = await axios.get('/allprod')
            if (res.status === 200) {
                this.allprod = res.data.prods
            }
        },
        GetProdName(id) {
            const produit = this.allprod.find(prod => prod.id === id)
            return produit ? produit.name_prod : ""
        },
        async GetCMD(id) {
            this.addModal = true
            const res = await axios.get('/getcmd/' + id)
            if (res.status === 200) {
                this.getcmd = res.data.cmd
            }
        },
        async ValideCMD() {
            this.getcmd.status = "En Cours"
            const res = await axios.post('/updatecmd', this.getcmd)
            if (res.status === 200) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Commande valider avec succès",
                    showConfirmButton: false,
                    timer: 1500
                })
                const index = this.allcmd.findIndex(cmd => cmd.id === this.getcmd.id)
                if (index !== -1) {
                    this.allcmd[index] = this.getcmd
                }
                this.getcmd = {}
                this.addModal = false
            }
        },
        async LivrerCMD() {
            this.getcmd.status = "Livré"
            const res = await axios.post('/updatecmd', this.getcmd)
            if (res.status === 200) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Commande livrer avec succès",
                    showConfirmButton: false,
                    timer: 1500
                })
                const index = this.allcmd.findIndex(cmd => cmd.id === this.getcmd.id)
                if (index !== -1) {
                    this.allcmd[index] = this.getcmd
                }
                this.getcmd = {}
                this.addModal = false
            }
        },
        async DelCMD(id) {
            const res = await axios.get('/getcmd/' + id)
            if (res.status === 200) {
                this.getcmd = res.data.cmd
                Swal.fire({
                    title: "Voulez-vous supprimer ce produits ?",
                    text: "Vous ne pourrez plus revenir en arrière !",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Supprimer",
                    cancelButtonText: "Fermer"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const ress = await axios.post('/delcmd', this.getcmd)
                        if (ress.status === 200) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Suppression effectuer",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            const index = this.allcmd.findIndex(cmd => cmd.id === this.getcmd.id)
                            if (index !== -1) {
                                this.allcmd.splice(index, 1)
                            }
                        }
                    }
                })
            }
        }
    },
    created(){
        this.AllCmds()
        this.AllUser()
        this.AllUtili()
        this.AllProduit()
    }
}
</script>

<style>

</style>
