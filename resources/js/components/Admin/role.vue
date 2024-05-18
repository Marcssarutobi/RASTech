<template>
    <div>
        
        <div class="headers mb-3">
            <i class="fas fa-user-tag text-primary bg-dark"></i>
            <span class="headers_title">Role</span>
        </div>
        <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4">
            <button class="btn btn-dark rounded" @click="addModal = true">Ajouter un Role</button>
            <div class="search ">
                <input type="search" class="form-control" placeholder="Rechercher ..." name="" id="">
            </div>
        </div>
        <div class="tableau">
            <table class="table table-striped mb-3">
                <thead class="table-dark">
                    <tr>
                        <th>Nom Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="role in allrole" :key="role.id">
                        <td>{{ role.name_role }}</td>
                        <td>
                            <button class="btn btn-primary mr-3" @click="GetRole(role.id)" ><i class="fas fa-pen-to-square"></i></button>
                            <button class="btn btn-danger" @click="DelRole(role.id)"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="col-lg-12 justify-content-end">
                <paginate
                :page-count="totalPage"
                :click-handler="AllRole"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination justify-content-end'"
                :page-class="'page-item'"
                >
                </paginate>
            </div>
        </div>

         <!-- Modal Enrégistrement -->
         <div v-if="addModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                    <div class="modal-header">
                        <h5 class="modal-title">Enrégistrement de Role</h5>
                        <button type="button" class="btn btn-white" @click="addModal = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group mb-3">
                            <label for="">Nom Role :</label>
                            <input type="text" class="form-control" v-model="data.name_role">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="addModal = false"  data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" @click="AddRole" >Enrégistrer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal Enrégistrement -->
         <!-- Modal Modification -->
         <div v-if="updateModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                    <div class="modal-header">
                        <h5 class="modal-title">Modification de Role</h5>
                        <button type="button" class="btn btn-white" @click="updateModal = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group mb-3">
                            <label for="">Nom Role :</label>
                            <input type="text" class="form-control" v-model="getrole.name_role">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="updateModal = false"  data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" @click="UpadetRole">Modifiation</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal Modification -->

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
                addModal: false,
                data:{
                    name_role:""
                },
                allrole:{},
                currentPage: 1,
                totalPage: 0,
                getrole:{},
                updateModal: false
            }
        },
        methods:{
            async AddRole(){
                try {
                    if (this.data.name_role.trim() == "") {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "Le champ est vide",
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        })
                        this.addModal = true
                    } else {
                        const res = await axios.post('/createrole',this.data)
                        if (res.status === 200) {
                            this.allrole.unshift(res.data.newrole)
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                icon: "success",
                                title: "Rôle ajouter avec succès",
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            })
                            this.data.name_role = ""
                            this.addModal = false
                        }
                    }
                } catch (error) {
                    console.error('Erreur ici :', error)
                }
            },
            async AllRole(page){
                const res = await axios.get('/allrole?page='+page)
                if (res.status === 200) {
                    this.allrole = res.data.roles.data
                    this.currentPage = res.data.roles.current_page
                    this.totalPage = res.data.roles.last_page
                }
            },
            async GetRole(id){
                this.updateModal = true
                const res = await axios.get('/getrole/'+id)
                if (res.status === 200) {
                    this.getrole = res.data.role
                }
            },
            async UpadetRole(){
                try {
                    
                    if (this.getrole.name_role.trim() == "") {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "Le champ est vide",
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        })
                        this.updateModal = false
                    } else {
                        const res = await axios.post('/updaterole', this.getrole)
                        if (res.status === 200) {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                icon: "success",
                                title: "Modification effectuer avec succès",
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            })
                            const index = this.allrole.findIndex(role => role.id === this.getrole.id)
                            if (index !== -1) {
                                this.allrole[index] = this.getrole
                            }
                            this.getrole = {}
                            this.updateModal = false
                        }
                    }

                } catch (error) {
                    console.error('Erreur ici :', error)
                }
            },
            async DelRole(id){
                const res = await axios.get('/getrole/'+id)
                if (res.status === 200) {
                    this.getrole = res.data.role

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
                            const del = await axios.post('/delrole',this.getrole)
                            if (del.status === 200) {
                                Swal.fire({
                                    position:"center",
                                    icon:"success",
                                    title: "Suppression effectuer",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                const index = this.allrole.findIndex(role => role.id === this.getrole.id)
                                if (index !== -1) {
                                    this.allrole.splice(index,1)
                                }
                            }
                            
                        }
                    });
                }
            }
        },
        created(){
            this.AllRole()
        }
    }
</script>

<style scoped>

</style>