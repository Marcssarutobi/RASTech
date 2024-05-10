<template>
    <div>
        
        <div class="headers mb-3">
            <i class="fas fa-cubes text-primary bg-dark"></i>
            <span class="headers_title">Produits</span>
        </div>

        <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4">
            <button class="btn btn-dark rounded" @click="addModal = true">Ajouter un Produits</button>
            <div class="search ">
                <input type="search" class="form-control" placeholder="Rechercher ..." name="" id="">
            </div>
        </div>

        <div class="tableau">
            <table class="table table-striped mb-3">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nom du produits</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Prix de vente</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody >
                    <tr >
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            
                            <button class="btn btn-primary mr-3" @click="GetCat(cat.id)"><i class="fas fa-pen-to-square"></i></button>
                            <button class="btn btn-danger" @click="DelCat(cat.id)"><i class="fas fa-trash"></i></button>

                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <!-- <div class="col-lg-12 justify-content-end">
                <pagination v-model="currentPage" :records="allCat.data" :per-page="6" @paginate="AllCategorie"/>
            </div> -->
        </div>

        <!-- Modal Enrégistrement -->
        <div v-if="addModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable ">
                    <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                        <div class="modal-header">
                            <h5 class="modal-title">Enrégistrement de Produits</h5>
                            <button type="button" class="btn btn-white" @click="addModal = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                        </div>
                        <div class="modal-body">
                        
                            <div class="image mb-3">

                                <label for="img">
                                    <input type="file" id="img" hidden @change="handleFileImg">
                                    <i class="fa fa-cloud-upload-alt"></i>
                                    <p>Télécharger une image</p>
                                </label>

                                <section class="progress-area" v-if="ShowProgress">
                                    <li class="rows">

                                        <i class="fas fa-file-alt" ></i>
                                        <div class="content">
                                            <div class="details">
                                                <span class="name">{{ names }} ~ Téléchargement...</span>
                                                <div class="percent">{{ percent }}%</div>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress" :style="'width:'+ percent + '%'"></div>
                                            </div>
                                        </div>

                                    </li>
                                </section>
                                <section class="uploaded-area" v-if="ShowUploded">
                                    <li class="rows">
                                        <div class="content">
                                            <i class="fas fa-file-alt" ></i>
                                            <div class="details">
                                                <span class="name">{{names}} ~ Télécharger</span>
                                                <div class="size">{{size}}</div>
                                            </div>
                                        </div>
                                        <i class="fas fa-check"></i>
                                    </li>
                                </section>

                            </div>
                            <div class="form-group mb-3">
                                <label for="">Nom du produits :</label>
                                <input type="text" class="form-control" >
                            </div>
                            <div class="form-group mb-3 cat">
                                <label for="">Catégorie :</label>
                                <select class="form-control" >
                                    <option selected disabled>Selectionnez une catégorie</option>
                                    <option v-for="cat in Cats" :key="cat.id" :value="cat.id">{{ cat.name_cat }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Quantité :</label>
                                <input type="number" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Prix de vente (FCFA) :</label>
                                <input type="number" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description :</label>
                                <textarea  class="form-control"  cols="30" rows="10"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="addModal = false"  data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary"  >Enrégistrer</button>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Fin Modal Enrégistrement -->

    </div>
</template>

<script>
import axios from 'axios';

    export default {
        data(){
            return{
                addModal:false,
                Cats:{},
                data:{
                    image:"",
                    name_prod:"",
                    categorie_id:"",
                    qte:"",
                    PVente:"",
                    description:""
                },
                percent: "",
                names:"",
                ShowProgress: false,
                ShowUploded:false,
                size:"",
            }
        },
        methods:{
            async AllCategorie(){
                const res = await axios.get('/Categories')
                if (res.status === 200) {
                    this.Cats = res.data.categories
                    console.log(this.Cats)
                }
            },
            async handleFileImg(event){
                const selectImg = event.target.files[0]
                if (selectImg && selectImg.type.startsWith('image/')) {
                    const formData = new FormData()
                    formData.append('image',selectImg)

                    try {
                        
                        const res = await axios.post('/uploadimg',formData,{
                            onUploadProgress:(ProgressEvent)=>{
                                const percentCompleted = Math.round((ProgressEvent.loaded * 100) / ProgressEvent.total)
                                this.percent = percentCompleted
                                this.names = selectImg.name

                                if (this.percent < 100) {
                                    this.ShowProgress = true
                                }else if(this.percent && selectImg.name){
                                    this.ShowProgress = false
                                    this.ShowUploded = true
                                }

                                if (selectImg.size < 1000) {
                                    this.size = selectImg.size + " o";
                                } else if (selectImg.size >= 1000 && selectImg.size < 1000000) {
                                    this.size = (selectImg.size / 1000).toFixed(2) + " ko";
                                } else if (selectImg.size >= 1000000) {
                                    this.size = (selectImg.size / 1000000).toFixed(2) + " Mo";
                                }
                            }
                        })

                        if (res.status === 200) {
                            this.data.image = res.data.image_url
                        }

                    } catch (error) {
                        
                    }

                }
            },
            async handleFileImgUpdate(event){
                const selectImg = event.target.files[0]
                if (selectImg && selectImg.type.startsWith('image/')) {
                    const formData = new FormData()
                    formData.append('image',selectImg)

                    try {
                        
                        const res = await axios.post('/uploadimg',formData,{
                            onUploadProgress:(ProgressEvent)=>{
                                const percentCompleted = Math.round((ProgressEvent.loaded * 100) / ProgressEvent.total)
                                this.percent = percentCompleted
                                this.names = selectImg.name

                                if (this.percent < 100) {
                                    this.ShowProgress = true
                                }else if(this.percent && selectImg.name){
                                    this.ShowProgress = false
                                    this.ShowUploded = true
                                }

                                if (selectImg.size < 1000) {
                                    this.size = selectImg.size + " o";
                                } else if (selectImg.size >= 1000 && selectImg.size < 1000000) {
                                    this.size = (selectImg.size / 1000).toFixed(2) + " ko";
                                } else if (selectImg.size >= 1000000) {
                                    this.size = (selectImg.size / 1000000).toFixed(2) + " Mo";
                                }
                            }
                        })

                        if (res.status === 200) {
                            this.getProd.image = res.data.image_url
                        }

                    } catch (error) {
                        
                    }

                }
            },
        },
        created(){
            this.AllCategorie()
        }
    }
</script>

<style>

</style>
