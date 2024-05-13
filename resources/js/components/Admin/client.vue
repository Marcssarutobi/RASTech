<template>
  <div>
    <div class="headers mb-3">
        <i class="fas fa-user-tie text-primary bg-dark"></i>
        <span class="headers_title">Client</span>
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
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in alluser" :key="user.id">
                    <th>{{ user.username }}</th>
                    <th>{{ user.email }}</th>
                    <th>{{ user.role }}</th>
                    <th>
                        <button class="btn btn-primary mr-3" ><i class="fas fa-eye"></i></button>
                        <button class="btn btn-danger" ><i class="fas fa-trash"></i></button>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return{
            alluser:{}
        }
    },
    methods:{
        async GetAllUser(){
            const res = await axios.get('/alluser')
            if (res.status === 200) {
                this.alluser = res.data.users.data
                console.log(this.alluser)
            }
        }
    },
    created(){
        this.GetAllUser()
    }
}
</script>

<style>

</style>