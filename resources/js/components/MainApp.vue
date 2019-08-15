<template>
    <div class="container-scroller">
        <template v-if="authUser.id">
            <AppHeader></AppHeader>
            <div class="container-fluid page-body-wrapper">
                <AppSidebar></AppSidebar>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <router-view></router-view>
                    </div>
                    <AppFooter></AppFooter>

                </div>

            </div>
        </template>
        <template v-else>
            <router-view></router-view>
        </template>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex';

    import AppHeader from "./partials/AppHeader";
    import AppSidebar from "./partials/AppSidebar";
    import AppFooter from "./partials/AppFooter";

    export default {
        name: "MainApp",
        data() {
            return {
                show: true
            };
        },
        components: {AppFooter, AppSidebar, AppHeader},
        computed: {
            ...mapGetters(["authUser", "isAuthenticated"])
        }
    }
</script>

