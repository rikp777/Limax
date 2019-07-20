<template>
    <div class="user-read" v-if="user">
        <div class="user-img">
            <img src="https://images.unsplash.com/photo-1516542076529-1ea3854896f2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1351&q=80">
        </div>
        <div class="user-info">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ user.id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ user.name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ user.email }}</td>
                </tr>
            </table>
            <router-link to="/users">Back to all users</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "user-read",
        created() {
            throw(this.$router.params.id);
            if(this.users.length) {
                this.user = this.users.find((user) => user.id == this.$route.params.id);
            } else {
                axios.get('/api/user/${this.$route.params.id}')
                    .then((response) => {
                        this.user = response.data.user
                    });
            }
        },
        data() {
            return {
                user: null
            };
        },
        computed: {
            authUser() {
                return this.$store.getters.authUser;
            },
            users(){
                return this.$store.getters.users;
            }
        }
    }
</script>

<style scoped>
    .user-read {
        display: flex;
        align-items: center;
    }
    .user-img {
        flex: 1;
    }
    .user-img img {
        max-width: 160px;
    }
    .user-info {
        flex: 3;
        overflow: scroll;
    }
</style>