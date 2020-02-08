<template>
    <b-row>
        <b-colxx xl="7" lg="12" class="mb-4" >
            <div v-if="!update">
                <palletlabel-create />
            </div>
            <div v-else>
                <palletlabel-update
                :id="labelId"
                @createMode="createListener"
                />
                <!-- <h1> Update </h1> -->
            </div>
        </b-colxx>
        <b-colxx xl="5" lg="12" class="mb-4">
            <b-card :title="$t('palletlabel.list.title')">
                <farmer-palletlabel-list
                  @updateMode="updateListener"
                 />
            </b-card>
        </b-colxx>
    </b-row>
</template>
<script>
    import PalletlabelCreate from "../../../components/crudl/palletlabel/PalletlabelCreate";
    import PalletlabelUpdate from "../../../components/crudl/palletlabel/PalletlabelUpdate";
    import FarmerPalletlabelList from "../../../components/crudl/farmer/FarmerPalletlabelList"
    export default {
      data () {
        return {
          update: false,
          labelId: null
        }
      },
      components: {
          PalletlabelCreate,
          PalletlabelUpdate,
          FarmerPalletlabelList
      },
      methods: {
        updateListener(id) {
          console.log('update: ' + id)
          this.labelId = id
          this.update = true
        },
        createListener() {
          console.log('create')
          this.update = false
        }
      }
    }
</script>
