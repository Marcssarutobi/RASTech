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
                    <tr>
                        <td>Nom</td>
                        <td>Prénom</td>
                        <td>Téléphone</td>
                        <td>Email</td>
                        <td>Role</td>
                        <td>
                            <button class="btn btn-primary mr-3" ><i class="fas fa-pen-to-square"></i></button>
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
                                    <input type="file" id="file" accept="image/*" hidden >
                                    <div class="img-area">
                                        <i class="fas fa-cloud-arrow-up icon mb-2"></i>
                                        <h3 class="mb-3">Upload Image</h3>
                                        <p>Image size must be less than <span>2MB</span></p>
                                    </div>
                                    <button class="select-image mt-3 btn btn-primary w-100 btn-lg rounded-2 ">Select Image</button>
                                </div>

                            </div>

                            <div class="col-lg-8">

                                <div class="form-group mb-3">
                                    <label for="">Nom :</label>
                                    <input type="text" class="form-control" v-model="data.nom">
                                </div>

                            </div>
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

    </div>
</template>

<script>
    export default {
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
                addModal: false
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