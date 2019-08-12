<template>
    <div>
        <div class="btn-wrapper">
            <router-link to="/users/create" class="btn btn-primary btn-sm">Create</router-link>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <template v-if="!users">
                    <tr>
                        <td colspan="4" class="text-center">No Users Available</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="user in users.data" :key="user.id">
                        <td> {{ user.first_name}}</td>
                        <td> {{ user.email}}</td>
                        <td>
<!--                            <router-link :to="{ name: 'userRead', params: { id: user.id }}">View</router-link>-->
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <template v-if="users.meta">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item" v-for="index in users.meta.last_page" :key="index">
                        <a href="#" class="page-link" @click="getAllByPage(index)">{{index}}</a>
                    </li>
                </ul>
            </nav>
        </template>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';
    export default {
        name: 'user-list',
        computed: {
            ...mapState({ users: state => state.user.all }),
        },
        methods: {
            ...mapActions('user', ['getAll']),
            ...mapActions('user', ['getAllByPage']),
        },
        mounted() {
            if (this.users.length) {
                return;
            }
            this.getAll();
        }
    }
</script>

