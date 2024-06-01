<template>
    <div>
        
        <div class="headers mb-3">
            <i class="fas fa-users text-primary bg-dark"></i>
            <span class="headers_title">Partenaire</span>
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
                        <td>{{ user.username }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role }}</td>
                        <td>
                            <button class="btn btn-primary mr-3" ><i class="fas fa-eye"></i></button>
                            <button class="btn btn-danger" ><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            alluser: {},
            currentPage: 1,
            totalPage: 0
        }
    },
    methods: {
        async AllUser() {
            const res = await axios.get('/alluser')
            if (res.status === 200) {
                this.alluser = res.data.userPa.data
                this.currentPage = res.data.alluser.current_page
                this.totalPage = res.data.alluser.last_page
                console.log(this.alluser)
            }
        }
    },
    created() {
        this.AllUser()
    }
}
</script>

<style>
    
</style>