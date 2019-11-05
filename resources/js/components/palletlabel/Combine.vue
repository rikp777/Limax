<template>
    <div>
        <div class="row">
            <div class="col">
                <pallet-label-create
                        :updateId=0
                ></pallet-label-create>
<!--                id 0 = standard, id 1 = update mode (testing)                                -->
            </div>
            <div class="col">
                <pallet-label-list
                        v-if="!print.print"
                        @update="update = $event"
                        @print="print = $event"
                ></pallet-label-list>
            </div>
        </div>
    </div>

</template>

<script>
    import PalletLabelCreate from "./CreateUpdate";
    import PalletLabelList from "./List";
    import PalletLabelPdf from "./Pdf";

    export default {
        name: "combine",
        components: {PalletLabelPdf, PalletLabelList, PalletLabelCreate},
        data() {
            return {
                state: 1,
                id: 0,
                update: [],
                print: []
            }
        },
    }
</script>
