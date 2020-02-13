<template>
    <b-dropdown id="farmer" class="ml-2" variant="light" size="sm" toggle-class="language-button">
        <template slot="button-content">
            <span class="name">{{authFarmer.name}}</span>
        </template>
        <b-dropdown-item v-for="(farmer,index) in authUserFarmers" :key="index" @click="changeFarmer(farmer)">{{farmer.name}}</b-dropdown-item>
    </b-dropdown>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from "vuex";

    export default {
        name: "SelectFarmer.vue",
        methods: {
            ...mapMutations(['changeAuthFarmer']),
            ...mapActions(['setFarmer']),
            changeFarmer(farmer){
                this.setFarmer(farmer.uid);
                this.changeAuthFarmer(farmer);
                setTimeout(() => {
                    window.location.reload()
                }, 100)
            },
        },
        computed: {
            ...mapGetters({
                authFarmer: 'authFarmer',
                authUserFarmers: 'authUserFarmers',
            })
        }
    }
</script>

<style scoped>

</style>
