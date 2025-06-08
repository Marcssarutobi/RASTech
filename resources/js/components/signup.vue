<template>
    <div>
        <!-- Sign Up Start -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex flex-column align-items-center justify-content-between mb-3">
                                <router-link to="/" class="text-decoration-none mb-3">
                                    <span class="h1 text-uppercase text-primary bg-dark px-2">RAS</span>
                                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">TECH</span>
                                </router-link>
                                <h3>Inscription</h3>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Username</label>
                                <input type="text" class="form-control" id="floatingText" placeholder="jhondoe" v-model="data.username">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email address</label>
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="data.email">
                            </div>
                            <div class="form-group mb-4">
                                <label for="">Password</label>
                                <input type="password" class="form-control"  placeholder="Password" v-model="data.password">
                            </div>
                            <!-- <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div> -->
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4" @click="Singnup">S'inscrire</button>
                            <p class="text-center mb-0">Vous avez déjà un compte ? <router-link to="/signin">Connexion</router-link></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sign Up End -->
    </div>
</template>

<script>
    import axios from 'axios';
    import Swal from 'sweetalert2'
    export default {
        data(){
            return {
                data:{
                    username: "",
                    email: "",
                    password: "",
                    role:"client",
                    points:0
                },

            }
        },
        methods: {
            async Singnup(){
                try {

                    if (this.data.username.trim() == "" || this.data.email.trim() == "" || this.data.password.trim() == "" || this.data.role.trim() == "") {

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

                        const res = await axios.post('/createUser',this.data)
                        if (res.status === 200) {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                icon: "success",
                                title: "Inscription éffectuer avec succès",
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            })
                            this.data.username = ""
                            this.data.email = ""
                            this.data.password = ""
                            this.data.role = ""
                            this.$router.push('/signin')
                        }

                    }

                } catch (error) {
                    console.error('Erreur ici :',error)
                }
            }
        },
    }
</script>

<style>

</style>
