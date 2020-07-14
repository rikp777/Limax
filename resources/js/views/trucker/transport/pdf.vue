<template>
    <b-row>
        <b-colxx xl="12" lg="12" class="mb-4">
            <div>
                    <router-link :to="{ name: 'shippinglabel' }"  class="btn btn-lg btn-light btn-block" style="position: relative; z-index: 3">New</router-link>
                <br>
                <!-- <div class="separator mb-5"/> -->
                <shippinglabelscanpdf></shippinglabelscanpdf>
            </div>
        </b-colxx>
    </b-row>
</template>
<script>
    import shippinglabelscanpdf from "../../../components/crudl/trucker/shippinglabelscanpdf";
    export default {
        name: 'WeightDashboard',
        components: {
            shippinglabelscanpdf
        },
        data() {
            return {
            }
        },
        methods: {
        }
    }
</script>
