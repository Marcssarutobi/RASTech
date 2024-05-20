<template>
    <div>

        <div class="headers mb-3">
            <i class="fas fa-user-gear text-primary bg-dark"></i>
            <span class="headers_title">Gestion Utilisateur</span>
        </div>
        <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4">
            <button class="btn btn-dark rounded" @click="addModal = true">Ajouter un Utilisateur</button>
            <div class="search ">
                <input type="search" class="form-control" placeholder="Rechercher ..." name="" id="">
            </div>
        </div>
        <div class="tableau">
            <table class="table table-striped mb-3">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in alluser" :key="user.id">
                        <td>{{ user.nom }}</td>
                        <td>{{ user.prenom }}</td>
                        <td>{{ user.tel }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role }}</td>
                        <td>
                            <button class="btn btn-primary mr-3" @click="GetUser(user.id)"><i class="fas fa-pen-to-square"></i></button>
                            <button class="btn btn-danger" ><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal Enrégistrement -->
        <div v-if="addModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                    <div class="modal-header">
                        <h5 class="modal-title">Enrégistrement d'un Utilisateur</h5>
                        <button type="button" class="btn btn-white" @click="addModal = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="row g-5">
                            <div class="col-lg-4">

                                <div class="containers mx-auto" >
                                    <input type="file" id="file" accept="image/*" hidden @change="handleFileImg">
                                    <div class="img-area">
                                        <i class="fas fa-cloud-arrow-up icon mb-2"></i>
                                        <h3 class="mb-3">Upload Image</h3>
                                        <p>Image size must be less than <span>2MB</span></p>
                                        <img v-if="data.photo != ''" :src="data.photo" alt="Placeholder Image">
                                    </div>
                                    <button v-if="data.photo === ''" class="select-image mt-3 btn btn-primary w-100 btn-lg rounded-2 " @click="SelectImage">Select Image</button>
                                    <button v-else @click="DelImage" class="select-image mt-3 btn btn-danger w-100 btn-lg rounded-2 ">Supprimer</button>
                                </div>

                            </div>

                            <div class="col-lg-8">
                                <div class="row g-3">

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="">Nom :</label>
                                            <input type="text" class="form-control" v-model="data.nom">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="">Prénom :</label>
                                            <input type="text" class="form-control" v-model="data.prenom">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Téléphone :</label>
                                            <vue-tel-input v-model="data.tel"  mode="international" class="form-control"></vue-tel-input>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="">Email :</label>
                                            <input type="email" class="form-control" v-model="data.email">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="">Password :</label>
                                            <input type="password" class="form-control" v-model="data.password">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="">Role :</label>
                                            <select class="form-control" v-model="data.role">
                                                <option selected disabled>Selectionnez un role</option>
                                                <option v-for="role in allrole" :key="role.id" :value="role.name_role">{{ role.name_role }}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="addModal = false"  data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" @click="CreateUser" >Enrégistrer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal Enrégistrement -->
        <!-- Modal Modification -->
        <div v-if="updateModale" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier un Utilisateur</h5>
                        <button type="button" class="btn btn-white" @click="updateModale = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="row g-5">
                            <div class="col-lg-4">

                                <div class="containers mx-auto" >
                                    <input type="file" id="file" accept="image/*" hidden @change="handleFileImgUpdate">
                                    <div class="img-area">
                                        <i class="fas fa-cloud-arrow-up icon mb-2"></i>
                                        <h3 class="mb-3">Upload Image</h3>
                                        <p>Image size must be less than <span>2MB</span></p>
                                        <img v-if="getuser.photo != ''" :src="getuser.photo" alt="Placeholder Image">
                                    </div>
                                    <button v-if="getuser.photo === ''" class="select-image mt-3 btn btn-primary w-100 btn-lg rounded-2 " @click="SelectImage">Select Image</button>
                                    <button v-else @click="DelImageUpdate" class="select-image mt-3 btn btn-danger w-100 btn-lg rounded-2 ">Supprimer</button>
                                </div>

                            </div>

                            <div class="col-lg-8">
                                <div class="row g-3">

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="">Nom :</label>
                                            <input type="text" class="form-control" v-model="getuser.nom">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="">Prénom :</label>
                                            <input type="text" class="form-control" v-model="getuser.prenom">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Téléphone :</label>
                                            <vue-tel-input v-model="getuser.tel"  mode="international" class="form-control"></vue-tel-input>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="">Email :</label>
                                            <input type="email" class="form-control" v-model="getuser.email">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="">Role :</label>
                                            <select class="form-control" v-model="getuser.role">
                                                <option selected disabled>Selectionnez un role</option>
                                                <option v-for="role in allrole" :key="role.id" :value="role.name_role">{{ role.name_role }}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="updateModale = false"  data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" @click="UpdateUser" >Modifier</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal Modification -->

    </div>
</template>

<script>
    import { VueTelInput } from 'vue-tel-input';
    import 'vue-tel-input/vue-tel-input.css';
    import axios from 'axios';
    import Swal from 'sweetalert2'
    export default {
        components: {
            VueTelInput,
        },
        data(){
            return{
                data:{
                    nom:"",
                    prenom:"",
                    photo:"",
                    tel:"",
                    email:"",
                    password:"",
                    role:"",
                },
                addModal: false,
                allrole:{},
                alluser:{},
                getuser:{},
                updateModale:false,
            }
        },
        mounted(){
            
        },
        methods:{
            SelectImage(){
                const InputFile = document.querySelector('#file')
                InputFile.click()
            },
            async AllRole(){
                const res = await axios.get('/allrole')
                if (res.status === 200) {
                    this.allrole = res.data.rolesT
                }
            },
            async handleFileImg(event){
                const selectImg = event.target.files[0]
                if (selectImg && selectImg.type.startsWith('image/')) {
                    const formData = new FormData()
                    formData.append('photo',selectImg)

                    try {
                        
                        const res = await axios.post('/uploadimgU',formData)

                        if (res.status === 200) {
                            this.data.photo = res.data.image_url
                        }

                    } catch (error) {
                        console.error('Erreur ici :' , error)
                    }

                }
            },
            async DelImage(){
                const res = await axios.post('/delimgU',{photo: this.data.photo})
                if (res.status === 200) {
                    this.data.photo = ""
                }
            },
            async CreateUser(){
                const res = await axios.post("/createutili",this.data)
                if (res.status === 200) {
                    const user = {
                        email : this.data.email,
                        password: this.data.password,
                        role: this.data.role,
                        username: "none"
                    }
                    const users = await axios.post('/createUser',user)
                    if (users.status === 200) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "success",
                            title: "Enrégistrement effectuer avec succès",
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        })
                        this.data = {
                            nom:"",
                            prenom:"",
                            photo:"",
                            tel:"",
                            email:"",
                            password:"",
                            role:"",
                        }
                        this.addModal = false
                    }
                }
            },
            async AllUser(){
                const res = await axios.get('/allutili')
                if (res.status === 200) {
                    this.alluser = res.data.alluser.data
                }
            },
            async GetUser(id){
                this.updateModale = true
                const res = await axios.get('/getUtili/'+id)
                if (res.status === 200) {
                    this.getuser = res.data.user
                }
            },
            async handleFileImgUpdate(event){
                const selectImg = event.target.files[0]
                if (selectImg && selectImg.type.startsWith('image/')) {
                    const formData = new FormData()
                    formData.append('photo',selectImg)

                    try {
                        
                        const res = await axios.post('/uploadimgU',formData)

                        if (res.status === 200) {
                            this.getuser.photo = res.data.image_url
                        }

                    } catch (error) {
                        console.error('Erreur ici :' , error)
                    }

                }
            },
            async DelImageUpdate(){
                const res = await axios.post('/delimgU',{photo: this.getuser.photo})
                if (res.status === 200) {
                    this.getuser.photo = ""
                }
            },
            async UpdateUser(){
                const res = await axios.post('/updateutili',this.getuser)
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
                    const index = this.alluser.findIndex(user => user.id === this.getuser.id)
                    if (index !== -1) {
                        this.alluser[index] = this.getuser
                    }
                    this.getuser = {}
                    this.updateModale = false
                }
            }

        },
        created(){
            this.AllRole()
            this.AllUser()
        }
    }
</script>

<style >

    .containers{
        max-width: 300px;
        width: 100%;
        background: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .containers .img-area{
        position: relative;
        width: 100%;
        height: 240px;
        background: #e1e1e1;
        border-radius: 15px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .img-area .icon{
        font-size: 90px;
    }
    .img-area h3{
        font-size: 20px;
        font-weight: 500;
        margin-bottom: 6px;
    }
    .img-area p{
        color: #999;
    }
    .img-area p span{
        font-weight: 600;
    }
    .img-area img{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
        z-index: 100;
    }

</style>