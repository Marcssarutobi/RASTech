<template>
    <div>
        
        <div class="container-fluid">
            <div class="container">           
                <h1 class="mb-3">Mon Profil</h1>
                <div class="row g-5">
                    <div class="col-lg-4">
                        
                        <div class="containers mx-auto">
                            <input type="file" id="file" accept="image/*" hidden>
                            <div class="img-area">
                                <i class="fas fa-cloud-arrow-up icon mb-2"></i>
                                <h3 class="mb-3">Upload Image</h3>
                                <p>Image size must be less than <span>2MB</span></p>
                            </div>
                            <button class="select-image mt-3 btn btn-primary w-100 btn-lg rounded-2 ">Select Image</button>
                        </div>

                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header h2">
                                Vos information personnelle
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Nom :</label>
                                            <input type="text" class="form-control" v-model="data.nom">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Prénom :</label>
                                            <input type="text" class="form-control" v-model="data.prenom">
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="">Téléphone :</label>
                                            <vue-tel-input v-model="data.phone" mode="international" class="form-control"></vue-tel-input>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Ville :</label>
                                            <input type="text" class="form-control" v-model="data.ville">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Quartier :</label>
                                            <input type="text" class="form-control" v-model="data.quartier">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary btn-lg">Enrégistrer</button>
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
    export default{
        components: {
            VueTelInput,
        },
        data(){
            return {
                data:{
                    photo:"",
                    nom:"",
                    prenom:"",
                    phone:"",
                    ville:"",
                    quartier:"",
                    user_id:""
                }
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
                console.log(image)

                const reader = new FileReader()
                reader.onload = ()=>{
                    const imgUrl = reader.result
                    const img = document.createElement('img')
                    img.src = imgUrl
                    Block.appendChild(img)
                }
                reader.readAsDataURL(image)
            })
        },
        methods:{
            async CurrentUser(){
                const users = await axios.get('/currentUser')
                if (users.status === 200) {
                    this.user = users.data.user
                    console.log(this.user)
                }
            },
            async handleFileImg(event){
                const selectImg = event.target.files[0]
                if (selectImg && selectImg.type.startsWith('image/')) {
                    const formData = new FormData()
                    formData.append('photo',selectImg)

                    try {
                        
                        const res = await axios.post('/uploadimgC',formData)

                        if (res.status === 200) {
                            this.data.phone = res.data.image_url
                        }

                    } catch (error) {
                        console.error('Erreur ici :' , error)
                    }

                }
            },
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
        object-position: center;
        z-index: 100;
    }
    
</style>