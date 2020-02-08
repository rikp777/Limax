<template>
    <b-row>
        <b-colxx xl="12" lg="12" class="mb-4">
            <div>
              <router-link :to="{ name: 'palletlabelCreate' }"  class="btn btn-lg btn-light btn-block" style="position: relative; z-index: 3">New</router-link>
              <br>
              <!-- <div class="separator mb-5"/> -->
                <palletlabel-pdf />
            </div>
        </b-colxx>
    </b-row>
</template>
<script>
    import PalletlabelPdf from "../../../components/crudl/palletlabel/PalletlabelPdf"
    export default {
        components: {
            PalletlabelPdf
        }
    }
</script>
