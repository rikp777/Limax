<template>
    <div class="card">
        <div class="card-body">
            <template>
                <h5 class="card-title">Home</h5>
<!--                <div class="col-4">-->
<!--                    <div class="card">-->
<!--                        <div class="card-body">-->
<!--                            <h5 class="card-title">Connections</h5>-->
<!--                            <ul v-for="(farmer, index) in farmers">-->
<!--                                <li>{{farmer.name + ' ' + farmer.id}}</li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </template>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import {getToken} from '../common/jwt.service';
    import jwtService from "../common/jwt.service";

    export default {
        name: "Home",
        props: ['farmers'],
        computed: {

        },
        mounted() {

        },
        methods: {

        }
    }
</script>
