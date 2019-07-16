<template>
    <div id="main">
        <header-app></header-app>
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import HeaderApp from './HeaderApp.vue'
    export default {
        name: "MainApp",
        components: { HeaderApp }
    }
</script>
