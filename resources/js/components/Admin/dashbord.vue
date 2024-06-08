<template>
    <div class="dashboard">
        
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <router-link to="/dashbord" class="text-decoration-none mb-5 mx-auto">
                    <span class="h2 text-uppercase text-primary bg-dark px-2">RAS</span>
                    <span class="h2 text-uppercase text-dark bg-primary px-2 ml-n1">TECH</span>
                </router-link>
                
                <div class="navbar-nav w-100">
                    <router-link to="/dashbord/accuiel" class="nav-item nav-link active"><i class="fa fa-tachometer-alt ms-3"></i>Dashboard</router-link>
                    <router-link v-if="user.role === 'Admin' || user.role === 'Super-Admin'" to="/dashbord/categorie" class="nav-item nav-link active"><i class="fas fa-tag me-2"></i>Categories</router-link>
                    <router-link v-if="user.role === 'Admin' || user.role === 'Super-Admin'" to="/dashbord/produit" class="nav-item nav-link active"><i class="fas fa-cubes me-2"></i>Produits</router-link>
                    <router-link v-if="user.role === 'Admin' || user.role === 'Super-Admin'" to="/dashbord/client" class="nav-item nav-link active"><i class="fas fa-user-tie me-2"></i>Clients</router-link>
                    <router-link v-if="user.role === 'Admin' || user.role === 'Super-Admin'" to="/dashbord/commande" class="nav-item nav-link active"><i class="fas fa-bag-shopping me-2"></i>Commande</router-link>
                    <router-link v-if="user.role === 'Admin' || user.role === 'Super-Admin'" to="/dashbord/partenaire" class="nav-item nav-link active"><i class="fas fa-users me-2"></i>Partenaire</router-link>
                    <router-link v-if="user.role === 'Admin' || user.role === 'Super-Admin'" to="/dashbord/newsletter" class="nav-item nav-link active"><i class="fas fa-at me-2"></i>Newsletter</router-link>
                    <router-link v-if="user.role === 'Admin' || user.role === 'Super-Admin'" to="/dashbord/contact" class="nav-item nav-link active"><i class="fas fa-envelope me-2"></i>Contact</router-link>
                    <router-link v-if="user.role === 'Admin' || user.role === 'Super-Admin'" to="/dashbord/role" class="nav-item nav-link active"><i class="fas fa-user-tag me-2"></i>Role</router-link>
                    <router-link v-if="user.role === 'Admin' || user.role === 'Super-Admin'" to="/dashbord/user" class="nav-item nav-link active"><i class="fas fa-user-gear me-2"></i>Utilisateur</router-link>
                    <router-link v-if="user.role === 'Partenaire'" to="/dashbord/produitP" class="nav-item nav-link active"><i class="fas fa-cubes me-2"></i>Produits</router-link>
                    <router-link v-if="user.role === 'Partenaire'" to="/dashbord/panier" class="nav-item nav-link active"><i class="fas fa-bag-shopping me-2"></i>Panier <span class="badge bg-danger text-white rounded">{{ cartTotal }}</span></router-link>
                    <router-link v-if="user.role === 'Partenaire'" to="/dashbord/cmdP" class="nav-item nav-link active"><i class="fas fa-shop me-2"></i>Commande</router-link>
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
                            <router-link to="/dashbord/profilP" class="dropdown-item">My Profile</router-link>
                            <a href="#" class="dropdown-item">Settings</a>
                            <span style="cursor: pointer;" @click="Logout" class="dropdown-item">Log Out</span>
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
    import axios from 'axios';
    import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters(['cartTotal'])
    },
    data() {
        return {
            user: {},
            userinfo:{}
        }
    },
    methods:{
        async Logout(){
            await axios.post('/logout',null,{
                headers:{
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            })
            localStorage.removeItem('token')
            this.$router.push("/signin")
        },
        async CurrentUser() {
            const users = await axios.get('/currentUser')
            if (users.status === 200) {
                this.user = users.data.user
                this.UserInfoCurrent(this.user.id)
            }
        },
        async UserInfoCurrent(id) {
            try {
                const res = await axios.get('/getuserinfo/' + id)
                if (res.status === 200) {
                    this.userinfo = res.data.userCurrent
                }
            } catch (error) {
                console.error('Erreur ici :', error)
            }
        },
    },
    created() {
        this.CurrentUser()
    }
}
</script>

<style>
    .dashboard{
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
    }
</style>