<template>
    <div id="app-container" :class="getMenuType">
        <top-nav />
        <sidebar />
        <main>
            <div class="container-fluid">
                <div>
                    <b-jumbotron header="Farmer panel" lead="">
                        <p>For more information visit the documentation</p>
                        <b-button variant="primary" href="#">Documentation</b-button>
                    </b-jumbotron>
                </div>
                <router-view />
            </div>
        </main>
        <footer-component />
    </div>
</template>

<script>
    import Sidebar from '../../containers/menu/farmer/Sidebar'
    import TopNav from '../../containers/menu/farmer/TopNav'
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
        },
        mounted() {
            //console.log(this.$router.options.routes)
        }
    }
</script>

