<template>
    <b-navbar class="fixed-top" toggleable="md" type="dark">
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <router-link class="navbar-brand brand-logo" :to="{ name: 'home' }"><img src="https://www.limax.nl/images/limax-logo.png" alt="logo"/></router-link>
            <router-link class="navbar-brand brand-logo-mini" :to="{ name: 'home' }"><img src="https://www.limax.nl/images/limax-logo.png" alt="logo"/></router-link>
        </div>
        <b-collapse is-nav id="nav_collapse">
            <b-navbar-nav class="header-links">
                <b-nav-item href="#"><i class="mdi mdi-image-filter"></i>Gallery</b-nav-item>
                <b-nav-item href="#" active><i class="mdi mdi-email-outline"></i>Inbox</b-nav-item>
                <b-nav-item href="#"><i class="mdi mdi-calendar"></i>Calendar</b-nav-item>
            </b-navbar-nav>
            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown right>
                    <template slot="button-content">
                        <div class="row">
                            <div class="col">
                                <p>{{authUser.fullName}}</p>
                            </div>
                            <div class="col">
                                <img class="img-xs rounded-circle d-inline"
                                     src="https://scontent-amt2-1.cdninstagram.com/vp/8f0ae9ca18b7cff053b005cd7340428d/5DE4E6BD/t51.2885-15/e35/s320x320/38097047_703325176677934_6077619263483412480_n.jpg?_nc_ht=scontent-amt2-1.cdninstagram.com"
                                     alt="profile image">
                                <div class="count-indicator d-inline">
                                    <i class="icon mdi mdi-email-variant"></i>
                                    <span class="count">7</span>
                                </div>
                            </div>
                        </div>

                    </template>
                    <b-dropdown-item href="#">Profile</b-dropdown-item>
                    <b-dropdown-item>
                        <router-link :to="{ name: 'authLogout' }">Logout</router-link>
                    </b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: 'HeaderApp',
        computed: {
            ...mapGetters(["authUser", "isAuthenticated"])
        }
    }
</script>
