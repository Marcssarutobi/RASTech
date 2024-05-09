<template>
    <div>
        <!-- Sign Up Start -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex flex-column align-items-center justify-content-between mb-3">
                                <router-link to="/" class="text-decoration-none mb-3">
                                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                                </router-link>
                                <h3>Sign Up</h3>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Username</label>
                                <input type="text" class="form-control" id="floatingText" placeholder="jhondoe">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email address</label>
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            </div>
                            <div class="form-group mb-4">
                                <label for="">Password</label>
                                <input type="password" class="form-control"  placeholder="Password">
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                            <p class="text-center mb-0">Already have an Account? <router-link to="/signin">Sign In</router-link></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sign Up End -->
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style>

</style>