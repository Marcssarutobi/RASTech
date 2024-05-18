<template>
    <div>
        
        <div class="container-fluid">
            <div class="container">           
                <h1 class="mb-3">Mon Profil</h1>
                <div class="row g-5">
                    <div class="col-lg-4">
                        
                        <div class="containers mx-auto" >
                            <input type="file" id="file" accept="image/*" hidden @change="handleFileImg">
                            <div class="img-area">
                                <i class="fas fa-cloud-arrow-up icon mb-2"></i>
                                <h3 class="mb-3">Upload Image</h3>
                                <p>Image size must be less than <span>2MB</span></p>
                                <img v-if="userinfo && userinfo.profil !== null && userinfo.profil !== ''" :src="userinfo.profil" alt="">
                                <img v-else-if="!userinfo && data.profil != ''" :src="data.profil" alt="Placeholder Image">
                                
                            </div>
                            <button v-if="userinfo && !userinfo.profil && !data.profil" class="select-image mt-3 btn btn-primary w-100 btn-lg rounded-2 ">Select Image</button>
                            <button v-else @click="DelImage" class="btn btn-danger w-100 btn-lg rounded-2 mt-3">Supprimer</button>
                        </div>
                       

                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header h2">
                                Vos information personnelle
                            </div>
                            <div class="card-body" >
                                <div class="row g-3">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group" v-if="userinfo !== null">
                                            <label for="">Nom :</label>
                                            <input type="text" class="form-control" v-model="userinfo.nom">
                                        </div>
                                        <div class="form-group" v-else>
                                            <label for="">Nom :</label>
                                            <input type="text" class="form-control" v-model="data.nom">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group" v-if="userinfo !== null">
                                            <label for="">Prénom :</label>
                                            <input type="text" class="form-control" v-model="userinfo.prenom">
                                        </div>
                                        <div class="form-group" v-else>
                                            <label for="">Prénom :</label>
                                            <input type="text" class="form-control" v-model="data.prenom">
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group" v-if="userinfo !== null">
                                            <label for="">Téléphone :</label>
                                            <vue-tel-input v-model="userinfo.phone" mode="international" class="form-control"></vue-tel-input>
                                        </div>
                                        <div class="form-group" v-else>
                                            <label for="">Téléphone :</label>
                                            <vue-tel-input v-model="data.phone" mode="international" class="form-control"></vue-tel-input>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group" v-if="userinfo !== null">
                                            <label for="">Ville :</label>
                                            <input type="text" class="form-control" v-model="userinfo.ville">
                                        </div>
                                        <div class="form-group" v-else>
                                            <label for="">Ville :</label>
                                            <input type="text" class="form-control" v-model="data.ville">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group" v-if="userinfo !== null">
                                            <label for="">Quartier :</label>
                                            <input type="text" class="form-control" v-model="userinfo.quartier">
                                        </div>
                                        <div class="form-group" v-else>
                                            <label for="">Quartier :</label>
                                            <input type="text" class="form-control" v-model="data.quartier">
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="card-footer">
                                <button class="btn btn-primary btn-lg" v-if="userinfo ===null"  @click="AddUserinfo">Enrégistrer</button>
                                <button class="btn btn-primary btn-lg" v-else  >Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import { VueTelInput } from 'vue-tel-input';
    import 'vue-tel-input/vue-tel-input.css';
    import axios from 'axios';
    import Swal from 'sweetalert2'
    export default{
        components: {
            VueTelInput,
        },
        data(){
            return {
                data:{
                    profil:"",
                    nom:"",
                    prenom:"",
                    phone:"",
                    ville:"",
                    quartier:"",
                    user_id:""
                },
                userinfo:{},
                user:{},
                logger:false,
                
            }
        },
        mounted(){
            const SelectImage = document.querySelector('.select-image')
            const InputFile = document.querySelector('#file')
            const Block = document.querySelector('.img-area')

            SelectImage.addEventListener('click',()=>{
                InputFile.click();
            })
            InputFile.addEventListener('change',()=>{
                const image = InputFile.files[0]

                // const reader = new FileReader()
                // reader.onload = ()=>{
                //     const imgUrl = reader.result
                //     const img = document.createElement('img')
                //     img.src = imgUrl
                //     Block.appendChild(img)
                // }
                // reader.readAsDataURL(image)
            })
        },
        methods:{
            async CurrentUser(){
                const users = await axios.get('/currentUser')
                if (users.status === 200) {
                    this.user = users.data.user
                    this.UserInfoCurrent(this.user.id)
                    if (this.user) {
                        this.logger = true
                    }else{
                        this.logger = false
                    }
                }
            },
            async handleFileImg(event){
                const selectImg = event.target.files[0]
                if (selectImg && selectImg.type.startsWith('image/')) {
                    const formData = new FormData()
                    formData.append('profil',selectImg)

                    try {
                        
                        const res = await axios.post('/uploadimgC',formData)

                        if (res.status === 200) {
                            this.data.profil = res.data.image_url
                        }

                    } catch (error) {
                        console.error('Erreur ici :' , error)
                    }

                }
            },
            async DelImage(){
                const res = await axios.post('/delimgC',{profil: this.data.profil})
                if (res.status === 200) {
                    this.data.profil = ""
                }
            },
            async UserInfoCurrent(id){
                try {
                    const res = await axios.get('/getuserinfo/'+id)
                    if (res.status === 200) {
                        this.userinfo = res.data.userCurrent
                    }
                } catch (error) {
                    console.error('Erreur ici :', error)
                }
            },
            async AddUserinfo(){
                this.data.user_id = this.user.id
                const res = await axios.post('/usercreateinfo', this.data)
                if (res.status === 200) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: "Enrégistrement effectuer avec succès",
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    })
                }
            }
        },
        created(){
            this.CurrentUser()
        }
    }
</script>

<style>
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