<template>
    <b-row>
        <b-colxx xl="12" lg="12" class="mb-4">
            <div>
                <div v-for="role in authUser.roles" v-if="role.name === 'Trucker'">
                    <router-link :to="{ name: 'truckerShippinglabel' }"  class="btn btn-lg btn-light btn-block" style="position: relative; z-index: 3">New</router-link>
                </div>
                <div v-else>
                    <router-link :to="{ name: 'shippinglabelCreate' }"  class="btn btn-lg btn-light btn-block" style="position: relative; z-index: 3">New</router-link>
                </div>
              <br>
              <!-- <div class="separator mb-5"/> -->
                <shippinglabel-pdf />
            </div>
        </b-colxx>
    </b-row>
</template>
<script>
    import ShippinglabelPdf from "../../../components/crudl/shippinglabel/ShippinglabelPdf"
    import {mapGetters} from "vuex";
    export default {
        components: {
            ShippinglabelPdf
        },
        computed: {
            ...mapGetters(["authUser"])
        }
    }
</script>
