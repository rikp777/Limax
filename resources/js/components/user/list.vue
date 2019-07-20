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
<!--                            <router-link :to="/user/${ user.id }">View</router-link>-->
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    export default {
        name: 'user-list',
        mounted() {

            if(this.users.length){
                return;
            }

            this.$store.dispatch('user/getAll');
        },
        computed: mapGetters({
            users: 'user/all',
        }),
    }
</script>

<style scoped>
    .btn-wrapper {
        text-align: right;
        margin-bottom: 20px;
    }
</style>

