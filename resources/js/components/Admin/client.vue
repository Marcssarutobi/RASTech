<template>
  <div>
    <div class="headers mb-3">
      <i class="fas fa-user-tie text-primary bg-dark"></i>
      <span class="headers_title">Client</span>
    </div>

    <div class="btns d-flex align-item-center justify-content-between px-3 py-2 mb-4">
      <div></div>
      <div class="search">
        <input
          type="search"
          class="form-control"
          placeholder="Rechercher ..."
          name=""
          id=""
        />
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
              <button class="btn btn-primary mr-3" @click="GetUser(user.id)">
                <i class="fas fa-eye"></i>
              </button>
              <button class="btn btn-danger" @click="DelUser(user.id)">
                <i class="fas fa-trash"></i>
              </button>
            </th>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal Enrégistrement -->
    <div
      v-if="addModal"
      class="modal fade show"
      tabindex="-1"
      style="display: block; background: rgba(0, 0, 0, 0.5)"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" data-aos="zoom-in" data-aos-duration="300">
          <div class="modal-header">
            <h5 class="modal-title">Information du client</h5>
            <button
              type="button"
              class="btn btn-white"
              @click="addModal = false"
              data-bs-dismiss="modal"
              aria-label="Close"
            >
              <i class="fas fa-x"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="row gx-3">
              <div class="col-12 col-lg-6">
                <div class="images mx-auto">
                  <img :src="getuserinfo.profil" alt="" />
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <h5 class="mb-3">Nom : {{ getuserinfo.nom }}</h5>
                <h5 class="mb-3">Prénom : {{ getuserinfo.prenom }}</h5>
                <h5 class="mb-3">Email : {{ getuser.email }}</h5>
                <h5 class="mb-3">Téléphone : {{ getuserinfo.phone }}</h5>
                <h5 class="mb-3">Ville : {{ getuserinfo.ville }}</h5>
                <h5 class="mb-3">Quartier : {{ getuserinfo.quartier }}</h5>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="addModal = false"
              data-bs-dismiss="modal"
            >
              Fermer
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal Enrégistrement -->
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  data() {
    return {
      alluser: {},
      getuser: {},
      addModal: false,
      getuserinfo: {},
    };
  },
  methods: {
    async GetAllUser() {
      const res = await axios.get("/alluser");
      if (res.status === 200) {
        this.alluser = res.data.users.data;
      }
    },
    async GetUser(id) {
      this.addModal = true;
      const res = await axios.get("/getUser/" + id);
      if (res.status === 200) {
        this.getuser = res.data.user;
        this.GetUserInfo(this.getuser.id);
      }
    },
    
    async GetUserInfo(id) {
      const res = await axios.get("/getuserinfo/" + id);
      if (res.status === 200) {
        this.getuserinfo = res.data.userCurrent;
        if (!this.getuserinfo) {
          this.addModal = false;
          Swal.fire({
            position: "center",
            icon: "error",
            title: "Information de l'utilisateur non diponible",
            showConfirmButton: false,
            timer: 1500,
          });
        }
      }
    },
    
    async DelUser(id) {
      const res = await axios.get("/getUser/" + id);
      if (res.status === 200) {
        this.getuser = res.data.user;

        Swal.fire({
          title: "Es-tu sûr ?",
          text: "Vous ne pourrez pas revenir en arrière !",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Supprimer",
          cancelButtonText: "Annuler",
        }).then(async (result) => {
            if (result.isConfirmed) {
                const del = await axios.post("/deluser", this.getuser);
                if (del.status === 200) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Suppression effectuer",
                    showConfirmButton: false,
                    timer: 1500,
                });
                const index = this.alluser.findIndex((user) => user.id === this.getuser.id);
                if (index !== -1) {
                    this.alluser.splice(index, 1);
                }
                }
            }
        });
      }
    },
  },
  created() {
    this.GetAllUser();
  },
};
</script>

<style>
.images {
  width: 250px;
  height: 250px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 20px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  overflow: hidden;
}
.images img {
  max-width: 100%;
  max-height: 100%;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
