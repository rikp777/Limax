<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link class="navbar-brand" :to="{ name: 'home' }">Riks App</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <template v-if="!authUser">
                        <li>
                            <router-link :to="{ name: 'authLogin' }" class="nav-link">Login</router-link>
                        </li>
                    </template>
                    <template v-else>


                        <li class="nav-item dropdown">
                            <router-link :to="{ name: 'userList' }" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                Users <span class="caret"></span>
                            </router-link>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <router-link :to="{ name: 'userCreate' }"  class="dropdown-item">Create</router-link>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <router-link to="/" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                {{ authUser.last_name }} <span class="caret"></span>
                            </router-link>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <router-link :to="{ name: 'authLogout' }"  class="dropdown-item">Logout</router-link>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <router-link to="/" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                Palletlabels <span class="caret"></span>
                            </router-link>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <router-link :to="{ name: 'palletLabelCombine' }"  class="dropdown-item">Create</router-link>
                                <router-link :to="{ name: 'palletLabelList' }"  class="dropdown-item">List</router-link>
                            </div>
                        </li>


                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: 'HeaderApp',
        methods: {
            logout() {
                this.$store.commit('auth/logout');
                this.$router.push('/login');
            }

        },
        computed: mapGetters({
            authUser: 'auth/authUser',
        }),
    }
</script>