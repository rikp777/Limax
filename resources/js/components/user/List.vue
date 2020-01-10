<template>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="btn-wrapper">
                    <router-link :to="{ name: 'userCreate' }" class="btn btn-primary text-white">Create</router-link>
                </div>
                <hr>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody v-if="!users">
                    <tr>
                        <td colspan="4" class="text-center">No Users Available</td>
                    </tr>
            </tbody>
                <tbody v-else>
                    <tr v-for="(user, index) in paginate.data" :key="user.id">
                        <td> {{ user.id}}</td>
                        <td> {{ user.fullName}}</td>
                        <td> {{ user.email}}</td>
                        <td>
                            <router-link :to="{ name: 'userRead', params: { id: user.id }}"><i class="material-icons" data-toggle="tooltip" title="Edit" style="color: #F2AB58">&#xE8B8;</i></router-link>
                            <a href="/" class="delete" data-toggle="modal" @click="deleteUser(user.id, index)"><i class="material-icons" data-toggle="tooltip" title="Delete" style="color: #F2AB58">&#xE5C9;</i></a>
                        </td>
                    </tr>
                </tbody>
        </table>
        <hr>
        <template v-if="paginate.meta.total > 10">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <!--                <ul class="pagination">-->
                    <!--                    <li class="page-item" v-if="paginate.meta.currentPage !== 1">-->
                    <!--                        <button class="btn btn-primary text-white" @click="getAllByPage(paginate.meta.currentPage -1)">Previous</button>-->
                    <!--                    </li>-->
                    <!--                    <li class="page-item" v-for="(page, index) in paginate.meta.lastPage">-->
                    <!--                        <button class="btn btn-primary text-white" @click="getAllByPage(index +1)">{{index+1}}</button>-->
                    <!--                    </li>-->
                    <!--                    <li class="page-item" v-if="paginate.meta.currentPage !== paginate.meta.lastPage">-->
                    <!--                        <button class="btn btn-primary text-white" @click="getAllByPage(paginate.meta.currentPage +1)">Next</button>-->
                    <!--                    </li>-->
                    <!--                </ul>-->
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
<!--                        previous with click-->
                        <div class="btn-group mr-2" role="group" aria-label="First group" v-if="paginate.meta.currentPage !== 1">
                            <button class="btn btn-primary text-white" @click="getAllByPage(paginate.meta.currentPage -1)">Previous</button>
                        </div>
<!--                        previous but disabled (can't go back further)-->
                        <div class="btn-group mr-2" role="group" aria-label="First group" v-if="paginate.meta.currentPage === 1">
                            <button class="btn btn-primary text-white" disabled>Previous</button>
                        </div>
<!--                        all pages incase table becomes very big-->
                        <div class="btn-group mr-2" role="group" aria-label="Second group">
                             <button class="btn btn-primary text-white" v-for="(page, index) in paginate.meta.lastPage" @click="getAllByPage(index +1)" v-bind:class="{ active: index+1 === paginate.meta.currentPage }">{{index+1}}</button>
                        </div>
<!--                        next with click-->
                        <div class="btn-group mr-2" role="group" aria-label="Third group" v-if="paginate.meta.currentPage !== paginate.meta.lastPage">
                            <button class="btn btn-primary text-white" @click="getAllByPage(paginate.meta.currentPage +1)">Next</button>
                        </div>
<!--                        next but disabled (can't go further)-->
                        <div class="btn-group mr-2" role="group" aria-label="Third group" v-if="paginate.meta.currentPage === paginate.meta.lastPage">
                            <button class="btn btn-primary text-white" disabled>Next</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        name: 'user-list',
        computed: {
            users(){
                return this.$store.getters.users
            },
            paginate(){
                return this.$store.getters.all
            }
        },
        methods: {
            getAllUsers(){
                this.$store.dispatch("getAllUsers");
            },
            getAllByPage(id){
                this.$store.dispatch("getAllByPage", id);
            },
            deleteUser(id, index){
                this.$store.dispatch("deleteUser", id)
                    .then(() =>{
                        this.paginate.data.splice(index, 1)
                    })
            },
        },
        mounted() {
            this.getAllByPage(0);

        }
    }
</script>

