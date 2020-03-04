<template>
    <div id="app-container" :class="getMenuType">
        <top-nav />
        <sidebar />
        <main>
            <div class="container-fluid">
                <div v-if="$route.path === '/production'">
                    <b-jumbotron header="Production panel" lead="">
                        <p>For more information visit the documentation</p>
                        <b-button variant="primary" :href='$route.path + "/docs"'>Documentation</b-button>
                    </b-jumbotron>
                </div>
                <router-view v-else />
            </div>
        </main>
        <footer-component />
    </div>
</template>

<script>
    import Sidebar from '../../containers/menu/production/Sidebar'
    import TopNav from '../../containers/menu/production/TopNav'
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
