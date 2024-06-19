<template>
    <div>
        <div class="headers mb-3">
            <i class="fas fa-tag text-primary bg-dark"></i>
            <span class="headers_title">Catégories</span>
        </div>

        <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4">
            <button class="btn btn-dark rounded" @click="addModal = true">Ajouter une Catégories</button>
            <div class="search ">
                <input type="search" class="form-control" placeholder="Rechercher ..." name="" id="">
            </div>
        </div>

        <div class="tableau">
            <table class="table table-striped mb-3">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nom dela catégorie</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-for="cat in allCat.data" :key="cat.id">
                        <td>{{ cat.name_cat }}</td>
                        <td>
                            
                            <button class="btn btn-primary mr-3" @click="GetCat(cat.id)"><i class="fas fa-pen-to-square"></i></button>
                            <button class="btn btn-danger" @click="DelCat(cat.id)"><i class="fas fa-trash"></i></button>

                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="col-lg-12 justify-content-end">
                <paginate
                :page-count="totalPage"
                :click-handler="AllCategorie"
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
                            <h5 class="modal-title">Enrégistrement de catégorie</h5>
                            <button type="button" class="btn btn-white" @click="addModal = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                        </div>
                        <div class="modal-body">
                        
                            <div class="form-group mb-3">
                                <label for="">Nom Catégorie :</label>
                                <input type="text" class="form-control" v-model="data.name_cat">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="addModal = false"  data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary" @click="AddCategorie" >Enrégistrer</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Fin Modal Enrégistrement -->
        <!-- Modal Enrégistrement -->
        <div v-if="updateModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier une catégorie</h5>
                        <button type="button" class="btn btn-white" @click="updateModal = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                    </div>
                    <div class="modal-body">
                
                        <div class="form-group mb-3">
                            <label for="">Nom Catégorie :</label>
                            <input type="text" class="form-control" v-model="catId.name_cat">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="updateModal = false"  data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" @click="Update" >Modifier</button>
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
    import Paginate from "vuejs-paginate-next";
    
    export default {
        components:{
            Paginate
        },
        data() {
            return {
                addModal: false,
                updateModal:false,
                data: {
                    name_cat: ""
                },
                allCat: {},
                currentPage: 1,
                totalPage: 0,
                catId:{},
                Cats:{}
            }
        },
        methods: {
            async AddCategorie() {
                try {

                    if (this.data.name_cat.trim() === "") {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "Le champs ne doit pas être vide",
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        })
                        this.addModal = true
                    } else {

                        const res = await axios.post('/createCat', this.data)
                        if (res.status === 200) {
                            this.allCat.data.unshift(res.data.cat)
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                icon: "success",
                                title: "Catégorie enrégistrer avec succès",
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            })
                            this.data.name_cat = ""
                            this.addModal = false
                        }
                        
                    }
                    
                } catch (error) {
                    console.log('Erreur ici :', error)
                }
            },
            async AllCategorie(page) {
                const res = await axios.get('/allcat?page='+page)
                if (res.status === 200) {
                    this.allCat = res.data.categories
                    this.Cats = res.data.categories.data
                    this.currentPage = res.data.categories.current_page
                    this.totalPage = res.data.categories.last_page
                }
            },
            async GetCat(id) {
                this.updateModal = true
                const res = await axios.get('/getcat/' + id)
                if (res.status === 200) {
                    this.catId = res.data.cat
                }
            },
            async Update() {
                try {
                   
                    if (this.catId.name_cat.trim() === "") {
                         Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "veuillez remplire tous les champs",
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                         })
                        this.updateModal = true
                    } else {

                        const res = await axios.post('/update', this.catId)
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
                            const index = this.Cats.findIndex(cat => cat.id === this.catId.id)
                            if (index !== -1) {
                                this.Cats[index] = this.catId
                            }
                            this.catId = {}
                            this.updateModal = false
                        }
                        
                    }
                    
                } catch (error) {
                    console.log('erreur ici :',error)
                }
            },
            async DelCat(id) {
                const res = await axios.get('/getcat/' + id)
                if (res.status === 200) {
                    this.catId = res.data.cat
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
                            const ress = await axios.post('/delcat', this.catId)
                            if (ress.status === 200) {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Suppression effectuer",
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                const index = this.Cats.findIndex(cat => cat.id === this.catId.id)
                                if (index !== -1) {
                                    this.Cats.splice(index, 1)
                                }
                            }
                        }
                    })
                }
            }
        },
        created() {
            this.AllCategorie()
        }
    }
</script>

<style>
    
</style>