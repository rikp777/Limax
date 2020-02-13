<template>
    <b-row>
        <b-colxx xl="7" lg="12" class="mb-4">
            <b-card :title="$t('shippinglabel.create.title')" style="border-left: 6px solid #f28125">
                <shippinglabel-create />
            </b-card>
        </b-colxx>
        <b-colxx xl="5" lg="12" class="mb-4">
            <b-card :title="$t('shippinglabel.list.title')">
                <farmer-shippinglabel-list :key="reloadComp"
                    @refreshMode="reloadListener"
                />
            </b-card>
        </b-colxx>
    </b-row>
</template>
<script>
    import ShippinglabelCreate from "../../../components/crudl/shippinglabel/ShippinglabelCreate";
    import FarmerShippinglabelList from "../../../components/crudl/farmer/FarmerShippinglabelList";
    import PalletlabelCreate from "../../../components/crudl/palletlabel/PalletlabelCreate";
    import PalletlabelUpdate from "../../../components/crudl/palletlabel/PalletlabelUpdate";
    import FarmerPalletlabelList from "../../../components/crudl/farmer/FarmerPalletlabelList";
    export default {
        components: {
            FarmerShippinglabelList,
            ShippinglabelCreate,
        },
        data () {
            return {
                update: false,
                labelId: null,
                reloadComp: 0,
            }
        },
        methods: {
            reloadListener() {
                this.reloadComp += 1
            },
        }
    }
</script>
