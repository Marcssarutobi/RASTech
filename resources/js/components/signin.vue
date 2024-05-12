<template>
    <div>
        <!-- Sign In Start -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex flex-column align-items-center justify-content-between mb-3">
                                <router-link to="/" class="text-decoration-none mb-3">
                                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                                </router-link>
                                <h3>Sign In</h3>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email address</label>
                                <input type="email" class="form-control"  placeholder="name@example.com" v-model="login.email">
                            </div>
                            <div class="form-group mb-4">
                                <label for="">Password</label>
                                <input type="password" class="form-control"  placeholder="Password" v-model="login.password">
                            </div>
                            <!-- <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div> -->
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4" @click="LoginForm">Sign In</button>
                            <p class="text-center mb-0">Don't have an Account? <router-link to="/signup">Sign Up</router-link></p>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Sign In End -->
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2'

    export default{

        data(){
            return{
                login:{
                    email:"",
                    password:""
                },
                user:{}
            }
        },
        methods:{
            async LoginForm(){
               try {
                
                if (this.login.email.trim() == "" || this.login.password.trim() == "") {
                    
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: "Les champs ne doit pas être vide",
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    })

                } else {
                    const res = await axios.post('login',this.login)
                    if (res.status === 200) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "success",
                            title: "Ravis de vous revoir",
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        })
                        
                        const users = await axios.get('/currentUser')
                        if (users.status === 200) {
                            this.user = users.data.user
                            if (this.user.role === "client") {
                                this.$router.push('/');
                            }
                        }
                        this.login.email = ""
                        this.login.password = ""
                    }
                }

               } catch (error) {
                    console.error('Erreur ici :', error)
               }
            },
           
        },
       created(){
        
       }

    }
</script>

<style>
    
</style>