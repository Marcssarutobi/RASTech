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
                    <td>{{ cmd.user_id }}</td>
                    <td>{{ cmd.prod_id }}</td>
                    <td>{{ cmd.qte }}</td>
                    <td>{{ cmd.prix }} FCFA</td>
                    <td>{{ cmd.status }}</td>
                    <td>Action</td>
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
            alluser:{}
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
    },
    created(){
        this.AllCmds()
    }
}
</script>

<style>

</style>