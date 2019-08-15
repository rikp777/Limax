<template>
    <section class="app-sidebar">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav" v-if="authUser">
                <li class="nav-item nav-profile">
                    <div class="nav-link">
                        <div class="profile-image">
                            <img
                                src="https://scontent-amt2-1.cdninstagram.com/vp/8f0ae9ca18b7cff053b005cd7340428d/5DE4E6BD/t51.2885-15/e35/s320x320/38097047_703325176677934_6077619263483412480_n.jpg?_nc_ht=scontent-amt2-1.cdninstagram.com"
                                alt="image"/> <span class="online-status online"></span>
                        </div>
                        <div class="profile-name">
                            <p class="name">{{authUser.lastName + ','}} {{ authUser.firstName}}</p>
                            <p v-if="authUser.departments" class="designation" v-for="department in authUser.departments" v-text="department.name "></p>
                            <div v-if="authUser.roles" class="badge badge-outline-dark x-auto mt-3" v-for="role in authUser.roles" v-text="role.name "></div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/">
                        <font-awesome-icon icon="home" class="menu-icon"></font-awesome-icon>
                        <span class="menu-title">Dashboard</span></router-link>
                </li>
                <li class="nav-item" v-for="(farmer, index) in authUser.farmers">
                    <span class="nav-link" v-b-toggle="'farmer-'+index">
                        <font-awesome-icon icon="tractor" class="menu-icon"></font-awesome-icon>
                        <span class="menu-title"><span v-if="authUser.farmers.length > 1" class="mr-">{{farmer.id}}.</span> {{farmer.name}}</span>
                        <font-awesome-icon icon="angle-down" class="menu-arrow"></font-awesome-icon>
                    </span>
                    <b-collapse :id="'farmer-'+index">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                 <span class="nav-link" v-b-toggle="'palletLabel-' + index">
                                    <font-awesome-icon icon="list-alt" class="menu-icon"></font-awesome-icon>
                                    <span class="menu-title">PalletLabel</span>
                                    <font-awesome-icon icon="angle-down" class="menu-arrow"></font-awesome-icon>
                                </span>
                            </li>
                            <b-collapse :id="'palletLabel-' + index">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{ name: 'palletLabelCombine' }">
                                            <font-awesome-icon icon="plus" class="menu-icon"></font-awesome-icon>
                                            <span class="menu-title">Create</span>
                                        </router-link>
                                    </li>
                                </ul>
                            </b-collapse>
                            <li class="nav-item">
                                <router-link class="nav-link" to="/alerts/">
                                    <font-awesome-icon icon="cogs" class="menu-icon"></font-awesome-icon>
                                    <span class="menu-title">Settings</span>
                                </router-link>
                            </li>
                        </ul>
                    </b-collapse>
                </li>
            </ul>
        </nav>
    </section>

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
