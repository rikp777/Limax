<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link class="navbar-brand" to="/">My Vue App</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <template v-if="!authUser">
                        <li>
                            <router-link to="/login" class="nav-link">Login</router-link>
                        </li>
                    </template>
                    <template v-else>
                        <li>
                            <router-link to="/users" class="nav-link">Users</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                {{ authUser.last_name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="#!" @click.prevent="logout" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'HeaderApp',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            }
        },
        computed: {
            authUser() {
                return this.$store.getters.authUser
            }
        }
    }
</script>