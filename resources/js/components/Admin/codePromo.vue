<template>
  <div>

    <div class="headers mb-3">
        <i class="fa-solid fa-hashtag text-primary bg-dark"></i>
        <span class="headers_title">Code Promo</span>
    </div>

    <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4">
        <button class="btn btn-dark rounded" @click="showModal">Ajouter un code promo</button>
        <div class="search ">
            <input type="search" class="form-control" placeholder="Rechercher ..." name="" id="">
        </div>
    </div>

    <div class="tableau">

        <table class="table table-striped mb-3">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Pourcentage</th>
                    <th scope="col">Expire le</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(code,index) in allcode" :key="index" >
                    <td>{{ code.code }}</td>
                    <td>{{ code.pourcentage }}%</td>
                    <td>{{ formatDate(code.expire) }}</td>
                    <td>
                        <span v-if="new Date(code.expire) > new Date()" class="badge bg-success text-white p-1">En Cours</span>
                        <span v-else class="badge bg-danger">Expiré</span>
                    </td>
                    <td>
                        <button class="btn btn-primary mr-3" @click="GetCodePromo(code.id)"><i class="fas fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" @click="DeleteCodePromo(code.id)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

    <!--  Modal content for the Large example -->
    <div class="modal fade" id="add_code" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Ajouter un code promo</h4>
                    <button @click="closeModal" type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="">N° Code</label>
                                <div class="input-group">
                                    <input type="text" :class="isEmpty.code ? 'is-invalid' : ''" v-model="data.code" disabled class="form-control rounded-0" placeholder="RT-236514">
                                    <button class="btn btn-primary" @click="generateAccountNumber">Générer un code</button>
                                </div>
                                <div v-if="isEmpty.code" class="invalid-feedback">
                                    {{ msgInput.code }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="">Pourcentage</label>
                                <input type="number" :class="isEmpty.pourcentage ? 'is-invalid' : ''" v-model="data.pourcentage" class="form-control rounded-0" >
                                <div v-if="isEmpty.pourcentage" class="invalid-feedback">
                                    {{ msgInput.pourcentage }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="">Date d'expiration</label>
                                <input type="date" :class="isEmpty.expire ? 'is-invalid' : ''" v-model="data.expire" class="form-control rounded-0" >
                                <div v-if="isEmpty.expire" class="invalid-feedback">
                                    {{ msgInput.expire }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger me-3" data-bs-dismiss="modal" @click="closeModal">Fermer</button>
                    <button disabled v-if="isLoader" class="btn btn-primary">
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    </button>
                    <button v-else type="button" class="btn btn-primary" @click="AddCodePromo">Enrégistrer</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

     <!--  Modal content for the Large example -->
     <div class="modal fade" id="update_code" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Modifier un code promo</h4>
                    <button type="button" @click="closeModalU" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="">N° Code</label>
                                <div class="input-group">
                                    <input type="text" :class="isEmpty.code ? 'is-invalid' : ''" v-model="getcode.code" disabled class="form-control rounded-0" placeholder="RT-236514">
                                    <button class="btn btn-primary" @click="generateAccountNumberUpdate">Générer un code</button>
                                </div>
                                <div v-if="isEmpty.code" class="invalid-feedback">
                                    {{ msgInput.code }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="">Pourcentage</label>
                                <input type="number" :class="isEmpty.pourcentage ? 'is-invalid' : ''" v-model="getcode.pourcentage" class="form-control rounded-0" >
                                <div v-if="isEmpty.pourcentage" class="invalid-feedback">
                                    {{ msgInput.pourcentage }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="">Date d'expiration</label>
                                <input type="date" :class="isEmpty.expire ? 'is-invalid' : ''" v-model="getcode.expire" class="form-control rounded-0" >
                                <div v-if="isEmpty.expire" class="invalid-feedback">
                                    {{ msgInput.expire }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger me-3" @click="closeModalU" data-bs-dismiss="modal">Fermer</button>
                    <button disabled v-if="isLoader" class="btn btn-primary">
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    </button>
                    <button v-else type="button" class="btn btn-primary" @click="UpdateCodePromo">Modifier</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  </div>
</template>

<script setup>

    import { onMounted, ref } from 'vue';
    import Swal from 'sweetalert2';
    import axios from 'axios';

    let addmodal;
    let updatemodal;

    const allcode = ref([])
    const data = ref({
        code:'',
        pourcentage:'',
        expire:'',
    })
    const isEmpty = ref({})
    const msgInput = ref({})
    const isLoader = ref(false)
    const getcode = ref({})

    const AllCodePromo = async ()=>{
        const res = await axios.get('/allcodepromo',{
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        })
        if (res.status === 200) {
            allcode.value = res.data.CodePromo
        }
    }

    //generation du code d'assurance
    const generateAccountNumber = () => {
        const prefix = 'RT-';
        const randomNumber = Math.floor(100000 + Math.random() * 999999);
        data.value.code = `${prefix}${randomNumber}`;
    }

    const inputEmty = ()=>{
        if (data.value.code.trim() === '') {
            isEmpty.value.code = true
            msgInput.value.code = 'Ce champs est vide'
        }else{
            isEmpty.value.code = false
            msgInput.value.code = ''
        }

        if (data.value.pourcentage === '') {
            isEmpty.value.pourcentage = true
            msgInput.value.pourcentage = 'Ce champs est vide'
        }else{
            isEmpty.value.pourcentage = false
            msgInput.value.pourcentage = ''
        }

        if (data.value.expire.trim() === '') {
            isEmpty.value.expire = true
            msgInput.value.expire = 'Ce champs est vide'
        } else if (data.value.expire.trim() !== '' && new Date(data.value.expire) <= new Date()) {
            isEmpty.value.expire = true
            msgInput.value.expire = 'Veuillez selectionnez une date future'
        } else{
            isEmpty.value.expire = false
            msgInput.value.expire = ''
        }
    }

    const AddCodePromo = async ()=>{
        inputEmty()
        const allEmpty = Object.values(isEmpty.value).every(value => value === false)
        if (allEmpty) {
            isLoader.value = true
            const res = await axios.post('/createcodepromo',data.value,{
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
            if (res.status === 200) {
                isLoader.value = false
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Enrégistrement éffectuer avec succès",
                    showConfirmButton: false,
                    timer: 1500
                })
                data.value = {
                    code:"",
                    pourcentage:"",
                    expire:"",
                }
                AllCodePromo()
                addmodal.hide()
            }
        }
    }

    const GetCodePromo = async (id)=>{
        updatemodal.show()
        const res = await axios.get('/showcodepromo/'+id,{
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        })
        if (res.status === 200) {
            getcode.value = res.data.CodePromo
        }
    }

    const generateAccountNumberUpdate = () => {
        const prefix = 'RT-';
        const randomNumber = Math.floor(100000 + Math.random() * 999999);
        getcode.value.code = `${prefix}${randomNumber}`;
    }

    const UpdateCodePromo = async ()=>{
        isLoader.value = true
        const res = await axios.put('/updatecodepromo/'+getcode.value.id,getcode.value,{
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        })
        if (res.status === 200) {
            isLoader.value = false
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Modification éffectuer avec succès",
                showConfirmButton: false,
                timer: 1500
            })
            getcode.value = {}
            AllCodePromo()
            updatemodal.hide()
        }
    }

    const DeleteCodePromo = async (id)=>{
        Swal.fire({
            title: "Voulez-vous supprimé ce Code Promo ?",
            text: "Vous ne pouvez plus revenir en arrière !",
            icon: "warning",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Supprimer",
            cancelButtonText: "Fermer"
        }).then(async (result) => {
            if (result.isConfirmed) {

                const del = await axios.delete('/deletecodepromo/' + id, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                })
                if (del.status === 200) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Suppression éffectuer",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    AllCodePromo()
                }
            }
        })
    }

    const showModal = ()=>{
        addmodal.show()
    }

    const closeModal = ()=>{
        addmodal.hide()
    }

    const closeModalU = ()=>{
        updatemodal.hide()
    }

    const formatDate = (dateString) => {
        if (!dateString) return "";

        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
    };

    onMounted(()=>{
        addmodal = new bootstrap.Modal(document.getElementById('add_code'))
        updatemodal = new bootstrap.Modal(document.getElementById('update_code'))
        AllCodePromo()
    })

</script>

<style>

</style>
