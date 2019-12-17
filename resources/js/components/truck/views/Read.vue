<template>
    <div>
        <div class="container-fluid container-application">

        </div>

    </div>
</template>

<script>
    import { mapGetters } from "vuex";
    import TruckActions from "../components/Actions";
    export default {
        name: "truckRead",
        components: {TruckActions},
        computed: {
            ...mapGetters(["truck"])
        },
        mounted() {
            this.$store.dispatch("getTruck", 1);
        }
    }
</script>

<style scoped>

</style>
