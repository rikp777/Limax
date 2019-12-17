<template>
    <section class="app-sidebar">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav" v-if="authUser">
                <li class="nav-item nav-profile">
                    <div class="nav-link">
                        <div class="profile-image">
                            <img
                                src="https://media.licdn.com/dms/image/C5603AQFJgyCX9voOdg/profile-displayphoto-shrink_200_200/0?e=1580947200&v=beta&t=4Tx1GPnqAUyPVvTaXEaX1s5f4xuyONQBS-R02ADiDwg"
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
                <li class="nav-item" v-for="(farmer, index) in authUser.farmers" @click="changeFarmerCookie(farmer.id)">
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
                                <router-link class="nav-link" to="/alerts/">
                                    <font-awesome-icon icon="cogs" class="menu-icon"></font-awesome-icon>
                                    <span class="menu-title">Settings</span>
                                </router-link>
                            </li>
                        </ul>
                    </b-collapse>
                </li>
                <li class="nav-item">
                    <span class="nav-link" v-b-toggle="'pricelist'">
                        <font-awesome-icon icon="dollar-sign" class="menu-icon"></font-awesome-icon>
                        <span class="menu-title">Pricelist</span>
                        <font-awesome-icon icon="angle-down" class="menu-arrow"></font-awesome-icon>
                    </span>
                    <b-collapse :id="'pricelist'">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'priceListCreate' }">
                                    <font-awesome-icon icon="plus" class="menu-icon"></font-awesome-icon>
                                    <span class="menu-title">Create</span>
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
                console.log(id);
                if(this.idFarmer !== id){
                    console.log('saveToken');
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
