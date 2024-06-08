<template>
    <div>
        
        <div class="container">
            
            <div class="headers mb-5">
                <i class="fas fa-shop text-primary bg-dark"></i>
                <span class="headers_title">Vos Commande</span>
            </div>

            <div class="tableau">
                <table class="table table-striped mb-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Nom du produits</th>
                            <th>Quantité</th>
                            <th>Montant Payé</th>
                            <th>Livraison</th>
                            <th>Status</th>
                            <th>Date de la Commande</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="cmd in allcmd" :key="cmd.id">
                            <td>{{ GetProdName(cmd.prod_id) }}</td>
                            <td>{{ cmd.qte }}</td>
                            <td>{{ cmd.prix }} FCFA</td>
                            <td>{{ cmd.livraison }}</td>
                            <td :class="cmd.status === 'New' ? 'alert alert-danger':cmd.status === 'En Cours' ? 'alert alert-warning': cmd.status === 'Livré' ? 'alert alert-success' : ''" > {{ cmd.status }}</td>
                            <td>{{ formatedDate(cmd.created_at) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</template>

<script>
    import axios from "axios";
    export default {
        data() {
            return {
                user: {},
                allcmd: {},
                allprod: {},
            }
        },
        methods: {
            async CurrentUser() {
                const users = await axios.get('/currentUser')
                if (users.status === 200) {
                    this.user = users.data.user
                    this.AllCmds(this.user.id)
                }
            },
            async AllCmds(id) {
                const res = await axios.get('/allcmds/'+id)
                if (res.status === 200) {
                    this.allcmd = res.data.cmd
                    console.log(this.allcmd)
                }
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
            formatedDate(dateString) {
                const date = new Date(dateString)
                moment.locale('fr')
                return moment(date).fromNow()
            }
        },
        created() {
            this.CurrentUser()
            this.AllProduit()
        }
    }
</script>

<style >

</style>