<template>
    <div id="app-container" :class="getMenuType">
        <top-nav />
        <sidebar />
        <main>
            <div class="container-fluid">
                <div v-if="$route.path === '/planner'">
                    <b-jumbotron header="Planner panel" lead="">
<!--                        <p>For more information visit the documentation</p>-->
<!--                        <b-button variant="primary" :href='$route.path + "/docs"'>Documentation</b-button>-->
                    </b-jumbotron>
                </div>
                <router-view v-else />
            </div>
        </main>
        <footer-component />
    </div>
</template>

<script>
    import Sidebar from '../../containers/menu/planning/Sidebar'
    import TopNav from '../../containers/menu/planning/TopNav'
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
            ...mapGetters(['getMenuType'])
        }
    }
</script>
