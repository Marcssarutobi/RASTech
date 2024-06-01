<template>
    <div>
        
        <div class="headers mb-3">
            <i class="fas fa-cubes text-primary bg-dark"></i>
            <span class="headers_title">Produits</span>
        </div>

        <div class="btns mb-4 px-3 ">
            <button :class="client ? 'btn-primary':'btn-dark'" class="btn   mr-3" @click="client = true">Produits clients</button>
            <button :class="!client ? 'btn-primary' :'btn-dark'" class="btn " @click="client = false">Produits Partenaire</button>
        </div>

        <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4" v-if="client">
            <button class="btn btn-dark rounded" @click="addModal = true">Ajouter un Produits</button>
            <div class="search ">
                <input type="search" class="form-control" placeholder="Rechercher ..." name="" id="">
            </div>
        </div>
        <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4" v-else>
            <button class="btn btn-dark rounded" @click="addModalP = true">Ajouter un Produits</button>
            <div class="search ">
                <input type="search" class="form-control" placeholder="Rechercher ..." name="" id="">
            </div>
        </div>

        <div class="tableau" v-if="client">
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
                    <tr v-for="prod in allprod.data" :key="prod.id">
                        <td>{{ prod.name_prod }}</td>
                        <td>{{ GetCateName(prod.categorie_id) }}</td>
                        <td>{{ prod.qte }}</td>
                        <td>{{ prod.PVente }}</td>
                        <td>
                            
                            <button class="btn btn-primary mr-3" @click="GetProduit(prod.id)"><i class="fas fa-pen-to-square"></i></button>
                            <button class="btn btn-danger" @click="DelProd(prod.id)"><i class="fas fa-trash"></i></button>

                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="col-lg-12 justify-content-end">
                <paginate
                :page-count="totalPage"
                :click-handler="AllProduit"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination justify-content-end'"
                :page-class="'page-item'"
                >
                </paginate>
            </div>
        </div>
        <div class="tableau" v-else>
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
                    <tr v-for="prodp in allprodP.data" :key="prodp.id">
                        <td>{{ prodp.name_prod }}</td>
                        <td>{{ GetCateName(prodp.categorie_id) }}</td>
                        <td>{{ prodp.qte }}</td>
                        <td>{{ prodp.PVente }}</td>
                        <td>
                        
                            <button class="btn btn-primary mr-3" @click="GetProduit(prodp.id)"><i class="fas fa-pen-to-square"></i></button>
                                <button class="btn btn-danger" @click="DelProd(prodp.id)"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                
                </tbody>
            </table>
            <div class="col-lg-12 justify-content-end">
                <paginate
                :page-count="totalPageP"
                :click-handler="AllProduitP"
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
                                        <div class="contente">
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
                                        <div class="contente">
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
                                <input type="text" class="form-control"  v-model="data.name_prod">
                            </div>
                            <div class="form-group mb-3 cat">
                                <label for="">Catégorie :</label>
                                <select class="form-control"  v-model="data.categorie_id">
                                    <option selected disabled>Selectionnez une catégorie</option>
                                    <option v-for="cat in Cats" :key="cat.id" :value="cat.id">{{ cat.name_cat }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Quantité :</label>
                                <input type="number" class="form-control" v-model="data.qte">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Prix de vente (FCFA) :</label>
                                <input type="number" class="form-control" v-model="data.PVente">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description :</label>
                                <textarea  class="form-control"  cols="30" v-model="data.description" rows="10"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="addModal = false"  data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary" @click="AddProduit" >Enrégistrer</button>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Fin Modal Enrégistrement -->
        <!-- Modal Enrégistrement ProduitP -->
        <div v-if="addModalP" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable ">
                    <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                        <div class="modal-header">
                            <h5 class="modal-title">Enrégistrement de Produits</h5>
                            <button type="button" class="btn btn-white" @click="addModalP = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
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
                                        <div class="contente">
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
                                        <div class="contente">
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
                                <input type="text" class="form-control"  v-model="data.name_prod">
                            </div>
                            <div class="form-group mb-3 cat">
                                <label for="">Catégorie :</label>
                                <select class="form-control"  v-model="data.categorie_id">
                                    <option selected disabled>Selectionnez une catégorie</option>
                                    <option v-for="cat in Cats" :key="cat.id" :value="cat.id">{{ cat.name_cat }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Quantité :</label>
                                <input type="number" class="form-control" v-model="data.qte">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Prix de vente (FCFA) :</label>
                                <input type="number" class="form-control" v-model="data.PVente">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description :</label>
                                <textarea  class="form-control"  cols="30" v-model="data.description" rows="10"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Disponibilité :</label>
                                <input type="date" class="form-control" name="" id="" v-model="data.dispo">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="addModalP = false"  data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary" @click="AddProduitP" >Enrégistrer</button>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Fin Modal Enrégistrement -->
        <!-- Modal Enrégistrement -->
        <div v-if="updateModal" class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, .5);">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable ">
                    <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
                        <div class="modal-header">
                            <h5 class="modal-title">Modification de Produits</h5>
                            <button type="button" class="btn btn-white" @click="updateModal = false"  data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                        </div>
                        <div class="modal-body">
                        
                            <div class="image mb-3" v-if="getProd.image == null">

                                <label for="img">
                                    <input type="file" id="img" hidden @change="handleFileImgUpdate">
                                    <i class="fa fa-cloud-upload-alt"></i>
                                    <p>Télécharger une image</p>
                                </label>

                                <section class="progress-area" v-if="ShowProgress">
                                    <li class="rows">

                                        <i class="fas fa-file-alt" ></i>
                                        <div class="contente">
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
                                        <div class="contente">
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
                            <div class="imageEdit mb-3 " v-if="getProd.image != null" style="display: flex; align-items: center; justify-content: flex-start; gap: 10px;">
                                <div class="image" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                    <img :src="getProd.image" alt="" style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <button type="button" class="btn btn-light " @click="DelImage"> <i class="fas fa-trash-can"></i> </button>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Nom du produits :</label>
                                <input type="text" class="form-control"  v-model="getProd.name_prod">
                            </div>
                            <div class="form-group mb-3 cat">
                                <label for="">Catégorie :</label>
                                <select class="form-control"  v-model="getProd.categorie_id">
                                    <option selected disabled>Selectionnez une catégorie</option>
                                    <option v-for="cat in Cats" :key="cat.id" :value="cat.id">{{ cat.name_cat }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Quantité :</label>
                                <input type="number" class="form-control" v-model="getProd.qte">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Prix de vente (FCFA) :</label>
                                <input type="number" class="form-control" v-model="getProd.PVente">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description :</label>
                                <textarea  class="form-control"  cols="30" v-model="getProd.description" rows="10"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="updateModal = false"  data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary" @click="UpdateProduit" >Modifier</button>
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
        data(){
            return{
                addModal:false,
                addModalP: false,
                updateModal:false,
                Cats:{},
                data:{
                    image:"",
                    name_prod:"",
                    categorie_id:"",
                    qte:"",
                    PVente:"",
                    description:"",
                    type:"",
                    dispo:""
                },
                percent: "",
                names:"",
                ShowProgress: false,
                ShowUploded:false,
                size:"",
                allprod:{},
                currentPage: 1,
                totalPage: 0,
                getProd: {},
                client: true,
                allprodP:{},
                currentPageP: 1,
                totalPageP: 0,
            }
        },
        methods:{
            async AllCategorie(){
                const res = await axios.get('/Categories')
                if (res.status === 200) {
                    this.Cats = res.data.categories
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
            async AddProduit(){
                try {
                    this.data.type = null
                    this.data.dispo = null
                    
                    if (this.data.image.trim() == "" || this.data.name_prod.trim() == "" || this.data.categorie_id == "" || this.data.qte == "" || this.data.PVente == "" || this.data.description.trim() == "") {
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
                        const res = await axios.post('/createpro',this.data)
                        if (res.status === 200) {
                            
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                icon: "success",
                                title: "Produit enrégistrer avec succès",
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            })
                            this.addModal = false
                            this.data.image = ""
                            this.data.name_prod = ""
                            this.data.categorie_id = ""
                            this.data.qte = ""
                            this.data.PVente = ""
                            this.data.description = ""
                            this.$route.push('/dashbord/produit')
                        }
                    }

                } catch (error) {
                    console.error('erreur ici :', error)
                }
            },
            async AddProduitP(){
                try {
                    this.data.type = "gros"
                    
                    if (this.data.image.trim() == "" || this.data.name_prod.trim() == "" || this.data.categorie_id == "" || this.data.qte == "" || this.data.PVente == "" || this.data.description.trim() == "" || this.data.dispo.trim() == "") {
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
                        console.log(this.data)
                        const res = await axios.post('/createpro',this.data)
                        if (res.status === 200) {
                            
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                icon: "success",
                                title: "Produit enrégistrer avec succès",
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            })
                            this.addModalP = false
                            this.data.image = ""
                            this.data.name_prod = ""
                            this.data.categorie_id = ""
                            this.data.qte = ""
                            this.data.PVente = ""
                            this.data.description = ""
                            this.data.type = ""
                            this.data.dispo = ""
                        }
                    }

                } catch (error) {
                    console.error('erreur ici :', error)
                }
            },
            async AllProduit(page){
                const res = await axios.get('/allprod?page='+page)
                if (res.status===200) {
                    this.allprod = res.data.produits
                    this.currentPage = res.data.produits.current_page
                    this.totalPage = res.data.produits.last_page
                }
            },
            async AllProduitP(page){
                const res = await axios.get('/allprod?page='+page)
                if (res.status===200) {
                    this.allprodP = res.data.prodP
                    this.currentPageP = res.data.prodP.current_page
                    this.totalPageP = res.data.prodP.last_page
                }
            },

            GetCateName(id){
                const categorie = this.Cats.find(cat => cat.id === id)
                return categorie ? categorie.name_cat : ""
            },
            async GetProduit(id){
                this.updateModal = true
                const res = await axios.get('/getpro/'+id)
                if (res.status === 200) {
                    this.getProd = res .data.prod
                }
            },
            async DelImage(){
                const res = await axios.post('/delimg',{image: this.getProd.image})
                if (res.status === 200) {
                    this.getProd.image = null
                }
            },
            async UpdateProduit(){
                try {
                    
                    const res = await axios.post('/updatepro',this.getProd)
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
                        const Prod = this.allprod.data
                        const index = Prod.findIndex(prod => prod.id === this.getProd.id)
                        if (index !== -1) {
                            Prod[index] = this.getProd
                        }
                        this.getProd = {}
                        this.updateModal = false
                    }

                } catch (error) {
                    console.log('error ici :', error)
                }
            },
            async DelProd(id){
                const res = await axios.get('/getpro/'+id)
                if (res.status === 200) {
                    this.getProd = res.data.prod
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
                            const ress = await axios.post('/delpro', this.getProd)
                            const del = await axios.post('/delimg',{image: this.getProd.image})
                            if (ress.status === 200 && del.status === 200) {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Suppression effectuer",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                const Prod = this.allprod.data
                                const index = Prod.findIndex(prod => prod.id === this.getProd.id)
                                if (index !== -1) {
                                    Prod.splice(index, 1)
                                }
                            }
                        }
                    })
                }
            }
        },
        created(){
            this.AllCategorie()
            this.AllProduit()
            this.AllProduitP()
        }
    }
</script>

<style>

</style>
