<template>
    <div class="col-8 mx-auto">
        <header-app></header-app>
        <transition name="slide-fade">
            <router-view v-if="show"></router-view>
        </transition>
    </div>
</template>

<script>
    import HeaderApp from './HeaderApp.vue'
    export default {
        name: "MainApp",
        data() {
            return {
                show: true
            };
        },
        components: { HeaderApp }
    }
</script>
<style>

    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all 0s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to{
        transform: translateX(10px);
        opacity: 0;
    }
</style>
