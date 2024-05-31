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
                    <td :style="cmd.status === 'New'?'font-weight: 600;':''">{{ GetUserName(cmd.user_id) }}</td>
                    <td :style="cmd.status === 'New'?'font-weight: 600;':''">{{ GetProdName(cmd.prod_id) }}</td>
                    <td :style="cmd.status === 'New'?'font-weight: 600;':''">{{ cmd.qte }}</td>
                    <td :style="cmd.status === 'New'?'font-weight: 600;':''">{{ cmd.prix }} FCFA</td>
                    <td :style="cmd.status === 'New'?'font-weight: 600;':''">{{ cmd.status }}</td>
                    <td>
                        <button class="btn btn-primary mr-3" ><i class="fas fa-eye"></i></button>
                        <button class="btn btn-danger" ><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return{
            allcmd:{},
            alluser: {},
            allprod:{}
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
        GetUserName(id) {
            const userInfo = this.alluser.find(user => user.id === id)
            return userInfo ? userInfo.nom +" "+ userInfo.prenom : ""
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
    },
    created(){
        this.AllCmds()
        this.AllUser()
        this.AllProduit()
    }
}
</script>

<style>

</style>