<template>
    <div>
        <div class="headers mb-3">
            <i class="fas fa-envelope text-primary bg-dark"></i>
            <span class="headers_title">Contacts</span>
        </div>

        <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4">
            <div></div>
            <div class="search ">
                <input type="search" class="form-control" placeholder="Rechercher ..." name="" id="">
            </div>
        </div>

        <div class="tableau">
            <table class="table table-striped mb-3">
                <thead class=" table-dark ">
                    <tr>
                        <td>Nom</td>
                        <td>Email</td>
                        <td>Subject</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="ctn in allctn" :key="ctn.id">
                        <td :style="ctn.status === 0?'font-weight: 600;':''">{{ ctn.name }}</td>
                        <td :style="ctn.status === 0?'font-weight: 600;':''">{{ ctn.email }}</td>
                        <td :style="ctn.status === 0?'font-weight: 600;':''">{{ ctn.subject }}</td>
                        <td>
                            <button class="btn btn-primary mr-3" @click="ViewCtn(ctn.id)"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-danger" @click="DeleteCtn(ctn.id)"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <paginate
                :page-count="totalPage"
                :click-handler="AllCtn"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination justify-content-end'"
                :page-class="'page-item'"
            >
            </paginate>
        </div>


         <!-- Modal View Contact -->
         <div v-if="view" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
                <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable ">
                    <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ getctn.name }}</h5>
                            <button type="button" class="btn btn-white" @click="view = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                        </div>
                        <div class="modal-body">
                        
                            <div class=" form-label d-flex flex-column mb-4">
                                <label for="">Subject :</label>
                                <label class="h5">{{ getctn.subject }}</label>
                            </div>
                            <div class=" form-label d-flex flex-column ">
                                <label for="">Message :</label>
                                <p class="container">{{ getctn.message }}</p>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="view = false"  data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary" @click="SendBtn">Répondre</button>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Fin Modal View Contact -->


         <!-- Modal View Contact -->
             <div v-if="send" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
                    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable ">
                        <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                            <div class="modal-header">
                                <h5 class="modal-title">Répondre au message</h5>
                                <button type="button" class="btn btn-white" @click="send = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                            </div>
                            <div class="modal-body">
                        
                                <div class="form-group">
                                    <label for="">Nom complet du client</label>
                                    <input type="text" class="form-control" v-model="getctn.name" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Adresse email du client</label>
                                    <input type="text" class="form-control" v-model="getctn.email" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Message</label>
                                    <textarea name="" class="form-control" v-model="data.message" id="" cols="30" rows="5"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="send = false"  data-bs-dismiss="modal">Fermer</button>
                                <button type="button" class="btn btn-primary" @click="SendEmails">Envoyer</button>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- Fin Modal View Contact -->

    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2'
import Paginate from "vuejs-paginate-next";
    export default {
        components:{
            Paginate
        },
        data(){
            return{
                allctn:{},
                getctn:{},
                currentPage: 1,
                totalPage: 0,
                view : false,
                send: false,
                data: {
                    name: "",
                    email: "",
                    message: "",
                }
            }
        },
        methods:{
            async AllCtn(page){
                try {
                    
                    const res = await axios.get('/allContact?page='+page)
                    if (res.status === 200) {
                        this.allctn = res.data.allctns.data
                        this.currentPage = res.data.allctns.current_page
                        this.totalPage = res.data.allctns.last_page
                    }

                } catch (error) {
                    console.error('Erreur ici: ',error)
                }
            },
            async ViewCtn(id){
                this.view = true
                const res = await axios.get('/getcontact/'+id)
                if (res.status === 200) {
                    this.getctn = res.data.ctn

                    this.getctn.status = 1
                    const update = await axios.post('/updatecontact',this.getctn)
                    if (update.status === 200) {
                        console.log('Vue')
                        const index = this.allctn.findIndex(ctn => ctn.id === this.getctn.id)
                        if (index !== -1) {
                            this.allctn[index] = this.getctn
                        }
                    }
                }
            },
            async DeleteCtn(id){
                const res = await axios.get('/getcontact/'+id)
                if (res.status === 200) {
                    this.getctn = res.data.ctn

                    Swal.fire({
                        title: "Es-tu sûr ?",
                        text: "Vous ne pourrez pas revenir en arrière !",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Supprimer",
                        cancelButtonText:"Annuler"
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            const del = await axios.post('/delcontact',this.getctn)
                            if (del.status === 200) {
                                Swal.fire({
                                    position:"center",
                                    icon:"success",
                                    title: "Suppression effectuer",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                const index = this.allctn.findIndex(ctn => ctn.id === this.getctn.id)
                                if (index !== -1) {
                                    this.allctn.splice(index,1)
                                }
                            }
                            
                        }
                    });

                }
            },
            SendBtn() {
                this.view = !this.view
                this.send = !this.send
            },
            async SendEmails() {
                try {
                    this.data.email = this.getctn.email
                    this.data.name = this.getctn.name
                    const res = await axios.post('/mail', this.data)
                    if (res.status === 200) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: res.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.send = false
                    }
                } catch (error) {
                    console.log(error)
                }
            }
        },
        created(){
            this.AllCtn()
        }
    }
</script>

<style>

</style>