<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Report 14-12-2019</h5>
                        <settings-update></settings-update>
                    </div>
                </div>
            </div>
<!--            <div class="col-4">-->
<!--                <div class="card">-->
<!--                    <div class="card-body">-->
<!--                        <h5 class="card-title">Connections</h5>-->
<!--                        <ul v-for="(farmer, index) in farmers">-->
<!--                            <li>{{farmer.name}}</li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>

</template>

<script>
    import SettingsUpdate from "./update";
    import {getToken} from '../../common/jwt.service';

    export default {
        name: "Index",
        components: {SettingsUpdate},
        props: ['farmers'],
        computed: {
            farmer(){
                return this.$store.getters.farmer;
            },
        },
        mounted() {
            this.getFarmer(getToken('farmer'))
        },
        methods: {
            getFarmer(id) {
                this.$store.dispatch("getFarmer", id);
            }
        }
    }
</script>

<style scoped>

</style>
