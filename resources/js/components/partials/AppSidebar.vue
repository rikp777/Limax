<template>
    <section class="app-sidebar">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav" v-if="authUser">
                <li class="nav-item nav-profile">
                    <div class="nav-link">
                        <div class="profile-image">
                            <img
                                src="https://images.assetsdelivery.com/compings_v2/salamatik/salamatik1801/salamatik180100019.jpg"
                                alt="image"/> <span class="online-status online"></span>
                        </div>
                        <div class="profile-name">
                            <p class="name">{{authUser.lastName + ','}} {{ authUser.firstName}}</p>
                            <p v-if="authUser.departments" class="designation" v-for="department in authUser.departments" v-text="department.name "></p>
                            <div v-if="authUser.roles" class="badge badge-outline-dark x-auto mt-3" v-for="role in authUser.roles" v-text="role.name"></div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/">
                        <font-awesome-icon icon="home" class="menu-icon"></font-awesome-icon>
                        <span class="menu-title">Dashboard</span></router-link>
                </li>
                <div v-for="authenticatedRole in authUser.roles">
                <li class="nav-item" v-if="authenticatedRole.name === 'Farmer' || authenticatedRole.name === 'Admin' || authenticatedRole.name === 'Moderator'" v-for="(farmer, index) in authUser.farmers" @click="changeFarmerCookie(farmer.id)">
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
                                        <router-link class="nav-link" :to="{ name: 'palletLabelCombine', params: { farmerId: index } }" replace>
                                            <font-awesome-icon icon="plus" class="menu-icon"></font-awesome-icon>
                                            <span class="menu-title">Create</span>
                                        </router-link>
                                    </li>
                                </ul>
                            </b-collapse>

                            <li class="nav-item">
                                 <span class="nav-link" v-b-toggle="'shippingLabel-' + index">
                                    <font-awesome-icon icon="list-alt" class="menu-icon"></font-awesome-icon>
                                    <span class="menu-title">ShippingLabel</span>
                                    <font-awesome-icon icon="angle-down" class="menu-arrow"></font-awesome-icon>
                                </span>
                            </li>
                            <b-collapse :id="'shippingLabel-' + index">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{ name: 'shippingLabelCombine' }">
                                            <font-awesome-icon icon="plus" class="menu-icon"></font-awesome-icon>
                                            <span class="menu-title">Create</span>
                                        </router-link>
                                    </li>
                                </ul>
                            </b-collapse>

                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'settingsRead', params: {'farmerId' : farmer.id } }">
                                    <font-awesome-icon icon="cogs" class="menu-icon"></font-awesome-icon>
                                    <span class="menu-title">Settings</span>
                                </router-link>
                            </li>

<!--                            <li class="nav-item">-->
<!--                                <router-link class="nav-link" :to="{ name: 'reportRead', params: {'farmerId' : farmer.id } }">-->
<!--                                    <font-awesome-icon icon="archive" class="menu-icon"></font-awesome-icon>-->
<!--                                    <span class="menu-title">Report</span>-->
<!--                                </router-link>-->
<!--                            </li>-->
                        </ul>
                    </b-collapse>
                </li>
                </div>
<!--                {{authUser.roles}}-->
                <div v-for="authenticatedRole in authUser.roles">
<!--                    {{authenticatedRole.name}}-->
                    <li class="nav-item" v-if="authenticatedRole.name === 'Admin' || authenticatedRole.name === 'Moderator'">
                    <span class="nav-link" v-b-toggle="'role-'+authUser.roles.id">
                        <font-awesome-icon icon="user-shield" class="menu-icon"></font-awesome-icon>
                        <span class="menu-title">Admin</span>
                        <font-awesome-icon icon="angle-down" class="menu-arrow"></font-awesome-icon>
                    </span>
                        <b-collapse :id="'role-'+authUser.roles.id">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                 <span class="nav-link" v-b-toggle="'user-' + authUser.roles.id">
                                    <font-awesome-icon icon="users" class="menu-icon"></font-awesome-icon>
                                    <span class="menu-title">Users</span>
                                    <font-awesome-icon icon="angle-down" class="menu-arrow"></font-awesome-icon>
                                </span>
                                </li>
                                <b-collapse :id="'user-' + authUser.roles.id">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item">
                                            <router-link class="nav-link" :to="{ name: 'userCreate' }" replace>
                                                <font-awesome-icon icon="plus" class="menu-icon"></font-awesome-icon>
                                                <span class="menu-title">Create</span>
                                            </router-link>
                                        </li>
                                        <li class="nav-item">
                                            <router-link class="nav-link" :to="{ name: 'userList' }" replace>
                                                <font-awesome-icon icon="plus" class="menu-icon"></font-awesome-icon>
                                                <span class="menu-title">Overview</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </b-collapse>

<!--                                <li class="nav-item">-->
<!--                                 <span class="nav-link" v-b-toggle="'article-' + authUser.roles.id">-->
<!--                                    <font-awesome-icon icon="list-alt" class="menu-icon"></font-awesome-icon>-->
<!--                                    <span class="menu-title">Articles</span>-->
<!--                                    <font-awesome-icon icon="angle-down" class="menu-arrow"></font-awesome-icon>-->
<!--                                </span>-->
<!--                                </li>-->
<!--                                <b-collapse :id="'article-' + authUser.roles.id">-->
<!--                                    <ul class="nav flex-column sub-menu">-->
<!--                                        <li class="nav-item">-->
<!--                                            <router-link class="nav-link" :to="{ name: 'articleCreate' }">-->
<!--                                                <font-awesome-icon icon="plus" class="menu-icon"></font-awesome-icon>-->
<!--                                                <span class="menu-title">Create</span>-->
<!--                                            </router-link>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </b-collapse>-->

                                <li class="nav-item">
                                <span class="nav-link" v-b-toggle="'pricelist-' + authUser.roles.id">
                                    <font-awesome-icon icon="dollar-sign" class="menu-icon"></font-awesome-icon>
                                    <span class="menu-title">Pricelist</span>
                                    <font-awesome-icon icon="angle-down" class="menu-arrow"></font-awesome-icon>
                                </span>
                                </li>
                                <b-collapse :id="'pricelist-' + authUser.roles.id">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item">
                                            <router-link class="nav-link" :to="{ name: 'priceListCreate' }">
                                                <font-awesome-icon icon="plus" class="menu-icon"></font-awesome-icon>
                                                <span class="menu-title">Create</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </b-collapse>

                            </ul>
                        </b-collapse>
                    </li>
                </div>

            </ul>
        </nav>
    </section>

</template>

<script>
    import {mapGetters} from 'vuex';
    import jwtService from "../../common/jwt.service";


    export default {
        name: 'HeaderApp',
        data() {
          return {
              idFarmer: null,
          }
        },
        computed: {
            ...mapGetters(["authUser", "isAuthenticated"])
        },
        methods: {
            changeFarmerCookie(id) {
                // console.log(id);
                if(this.idFarmer !== id){
                    // console.log('saveToken');
                    jwtService.destroyToken('farmer');
                    jwtService.saveToken('farmer', id);
                    this.idFarmer = id;
                    //QUICK FIX FOR FARMER ID'S!!!!!!!!!!!!!!!!!!!!!! (SWAPPED NAAR HOME ALS JE VAN FARMER VERANDERD)
                    this.$router.push( { name:  'home'} )
                }
            },
        }
    }
</script>
