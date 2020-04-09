<template>
    <div id="app-container" :class="getMenuType">
        <top-nav/>
        <sidebar/>
        <main>
            <div class="container-fluid">
                <div v-if="$route.path === '/admin'">
                    <div v-for="role in authUser.roles">
                        <div v-if="role.id === 1">
                            <b-jumbotron header="Admin panel" lead="">
                                <!--                        <p>For more information visit the documentation</p>-->
                                <!--                        <b-button variant="primary" :href='$route.path + "/docs"'>Documentation</b-button>-->
                            </b-jumbotron>
                        </div>
                        <div v-if="role.id === 2">
                            <b-jumbotron header="Moderator panel" lead="">
                                <!--                        <p>For more information visit the documentation</p>-->
                                <!--                        <b-button variant="primary" :href='$route.path + "/docs"'>Documentation</b-button>-->
                            </b-jumbotron>
                        </div>
                    </div>
                </div>
                <router-view v-else/>
            </div>
        </main>
        <footer-component/>
    </div>
</template>

<script>
    import Sidebar from '../../containers/menu/admin/Sidebar'
    import TopNav from '../../containers/menu/admin/TopNav'
    import Footer from '../../containers/Footer'
    import {
        mapGetters
    } from 'vuex'

    export default {
        components: {
            'top-nav': TopNav,
            'sidebar': Sidebar,
            'footer-component': Footer
        },
        data() {
            return {
                show: false
            }
        },
        computed: {
            ...mapGetters(['getMenuType', 'authUser'])
        }
    }
</script>
