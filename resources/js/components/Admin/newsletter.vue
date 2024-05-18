<template>
    <div>
        <div class="headers mb-3">
            <i class="fas fa-at text-primary bg-dark"></i>
            <span class="headers_title">Newsletter</span>
        </div>

        <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4">
            <div></div>
            <div class="search ">
                <input type="search" class="form-control" placeholder="Rechercher ..." name="" id="">
            </div>
        </div>
        <div class="tableau">
            <table class="table table-striped mb-3">
                <thead class="table-dark">
                    <tr>
                        <th>Email de l'abonner</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="news in allnew" :key="news.id">
                        <td>{{ news.email }}</td>
                        <td><button class="btn btn-danger" @click="GetNew(news.id)"><i class="fas fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
            <div class="col-lg-12 justify-content-end">
                <paginate
                :page-count="totalPage"
                :click-handler="AllNew"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination justify-content-end'"
                :page-class="'page-item'"
                >
                </paginate>
            </div>
        </div>

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
                allnew:{},
                getnew:{},
                currentPage: 1,
                totalPage: 0,
            }
        },
        methods:{
            async AllNew(page){
                const res = await axios.get('/allnew?page='+page)
                if (res.status === 200) {
                    this.allnew = res.data.News.data
                    this.currentPage = res.data.News.current_page
                    this.totalPage = res.data.News.last_page
                }
            },
            async GetNew(id){
                const res = await axios.get('/getnew/'+id)
                if (res.status === 200) {
                    this.getnew = res.data.new

        
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
                            const del = await axios.post('/delnew',this.getnew)
                            if (del.status === 200) {
                                Swal.fire({
                                    position:"center",
                                    icon:"success",
                                    title: "Suppression effectuer",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                const index = this.allnew.findIndex(news => news.id === this.getnew.id)
                                if (index !== -1) {
                                    this.allnew.splice(index,1)
                                }
                            }
                            
                        }
                    });

                }
            }
        },
        created(){
            this.AllNew()
        }
    }
</script>

<style>

</style>