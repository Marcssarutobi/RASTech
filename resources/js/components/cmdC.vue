<template>
    <div>

        <div class="container">

            <div class="headers mb-5" style="display: flex; align-items: center; justify-content: space-between;">
                <div class="icon" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <i class="fas fa-shop text-primary bg-dark"></i>
                    <span class="headers_title">Vos Commande</span>
                </div>
                <div class="user" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <h5 class="mb-0">Points: <span class="points">{{ user.points }}/20000 Points</span></h5>
                    <button class="btn btn-primary" @click="sendMail">Obtenir un code promo</button>
                </div>
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
import Swal from "sweetalert2";
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
            },
            async sendMail(){

                Swal.fire({
                    title: `Vous avez actuellement `+ this.user.points +` points.`,
                    text: "Souhaitez-vous recevoir un code promo maintenant ou attendre pour un meilleur pourcentage ?",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: "#d33",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Supprimer",
                    cancelButtonText: "Fermer"
                }).then(async (result) => {
                    if (result.isConfirmed) {

                        // Affiche un loader pendant l'envoi
                        Swal.fire({
                            title: 'Envoi en cours...',
                            text: 'Veuillez patienter pendant l\'envoi du code promo.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        try {
                            const res = await axios.post('/send-promo-code',{
                                user_id: this.user.id,
                            })
                            if (res.status === 200) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Code Promo Envoyé",
                                    text: "Le code promo a été envoyé avec succès !",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }

                        } catch (error) {
                            console.log(error)
                            if (error.response.status === 403) {
                                Swal.fire({
                                    icon: "error",
                                    text: error.response.data.message,
                                    text: error.response.data.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Erreur",
                                    text: "Une erreur s'est produite lors de l'envoi du code promo.",
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                            }
                        }

                    }
                })


            }
        },
        created() {
            this.CurrentUser()
            this.AllProduit()
        },

    }
</script>

<style >

</style>
