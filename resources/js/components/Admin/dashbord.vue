<template>
    <div class="dashboard">
        
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <router-link to="/dashbord" class="text-decoration-none mb-5 mx-auto">
                    <span class="h2 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h2 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </router-link>
                
                <div class="navbar-nav w-100">
                    <router-link to="/dashbord/accuiel" class="nav-item nav-link active"><i class="fa fa-tachometer-alt ms-3"></i>Dashboard</router-link>
                    <router-link to="/dashbord/categorie" class="nav-item nav-link active"><i class="fas fa-tag me-2"></i>Categories</router-link>
                    <router-link to="/dashbord/produit" class="nav-item nav-link active"><i class="fas fa-cubes me-2"></i>Produits</router-link>
                    <router-link to="/dashbord/client" class="nav-item nav-link active"><i class="fas fa-user-tie me-2"></i>Clients</router-link>
                    <a href="widget.html" class="nav-item nav-link active"><i class="fas fa-users me-2"></i>Partenaire</a>
                    <router-link to="/dashbord/newsletter" class="nav-item nav-link active"><i class="fas fa-at me-2"></i>Newsletter</router-link>
                    <router-link to="/dashbord/contact" class="nav-item nav-link active"><i class="fas fa-envelope me-2"></i>Contact</router-link>
                    <router-link to="/dashbord/role" class="nav-item nav-link active"><i class="fas fa-user-tag me-2"></i>Role</router-link>
                    <router-link to="/dashbord/user" class="nav-item nav-link active"><i class="fas fa-user-gear me-2"></i>Utilisateur</router-link>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <div class="contente">
            
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand w-100 align-item-center justify-content-between bg-light navbar-light sticky-top px-5 py-0">
                    
                <a href="#" class="sidebar-toggler  flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-auto">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../../../../public/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../../../../public/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="../../../../public/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../../../../public/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <div class="views">
                <router-view></router-view>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        
    }
</script>

<style>
    
</style>