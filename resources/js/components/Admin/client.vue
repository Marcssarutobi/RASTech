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
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>3</th>
                </tr>
            </tbody>
        </table>
    </div>

  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>