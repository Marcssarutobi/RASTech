<template>
    <div>
        
        <div class="container-fluid">
            <div class="container">           
                <h1 class="mb-3">Mon Profil</h1>
                <div class="row g-5 mb-4">
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
                            <div class="w-100" v-if="userinfo === null">
                                <button v-if=" data.profil === '' "  @click="SelectImage" class="select-image mt-3 btn btn-primary w-100 btn-lg rounded-2 ">Select Image</button>
                                <button v-else @click="DelImage" class="btn btn-danger w-100 btn-lg rounded-2 mt-3">Supprimer</button>
                            </div>
                            <div class="w-100" v-else>
                                <button v-if="!userinfo.profil " @click="SelectImage"  class="select-image mt-3 btn btn-primary w-100 btn-lg rounded-2 ">Select Image</button>
                                <button v-else @click="DelImageP" class="btn btn-danger w-100 btn-lg rounded-2 mt-3">Supprimer</button>
                            </div>
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

                <div class="row g-3 mb-3">
                    <div class="col-lg-5">
                        <img src="../../../public/img/part.jpg" class="img-fluid rounded w-100 h-100" style="max-width: 100%;max-height: 100%;" alt="">
                    </div>
                    <div class="col-lg-7">
                        <div class="text-start">
                            <h1>Devenir partenaire ?</h1>
                        </div>
                        <p style="text-align: justify;">Plongez dans une expérience enrichissante en explorant les nombreux avantages offerts par une collaboration avec MultiShop ! En tant que partenaire privilégié, vous aurez l'opportunité exclusive d'accéder à notre gamme de produits en gros, bénéficiant ainsi de tarifs compétitifs et d'une flexibilité accrue pour répondre aux besoins de votre entreprise. Nous vous garantissons non seulement des prix avantageux, mais aussi une qualité inégalée et un service client dédié, toujours prêts à vous accompagner dans chaque étape de votre parcours.</p>
                        <button v-if="!btn" @click="DemandePart" class="btn btn-primary btn-lg">Devenir partenaire</button>
                        <div class="alert-success p-3 rounded" v-if="btn">
                            <p class="m-0">Votre demande à été envoyer avec succès. Vous recevrez bientôt une notification </p>
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
                logger: false,
                btn: false
                
            }
        },
        mounted(){
            // const SelectImage = document.querySelector('.select-image')
            // const InputFile = document.querySelector('#file')
            // const Block = document.querySelector('.img-area')

            // SelectImage.addEventListener('click',()=>{
            //     InputFile.click();
            // })
            // InputFile.addEventListener('change',()=>{
            //     const image = InputFile.files[0]

            //     const reader = new FileReader()
            //     reader.onload = ()=>{
            //         const imgUrl = reader.result
            //         const img = document.createElement('img')
            //         img.src = imgUrl
            //         Block.appendChild(img)
            //     }
            //     reader.readAsDataURL(image)
            // })
        },
        methods:{
            SelectImage(){
                const InputFile = document.querySelector('#file')
                InputFile.click()
            },
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
            async DelImageP(){
                const res = await axios.post('/delimgC',{profil: this.userinfo.profil})
                if (res.status === 200) {
                    this.userinfo.profil = ""
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
            },
            async DemandePart() {
                const infos = {
                    name: this.userinfo.nom + " " + this.userinfo.prenom,
                    email: this.user.email,
                    subject: "Demande de Partenariat",
                    message: "Vous avez reçus une nouvelle demande de partenariat de monsieur " + this.userinfo.nom + " " + this.userinfo.prenom + ". Veuillez entrez en contact avec lui pour plus de renseignement.",
                    status: 0
                }
                const res = await axios.post('/createcontact', infos)
                if (res.status === 200) {
                    this.btn = true
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