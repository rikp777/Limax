<template>
    <div>
        <div class="row">
            <div class="col">
                <pallet-label-create
                        v-if="!update.update && !print.print"
                        @print="print = $event"
                ></pallet-label-create>
                <pallet-label-update
                        v-if="update.update && print.print"
                        @print="print = $event"
                ></pallet-label-update>
            </div>
            <div class="col">
                <pallet-label-list
                        v-if="!print.print"
                        @update="update = $event"
                        @print="print = $event"
                ></pallet-label-list>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <pallet-label-pdf
                        v-if="print.print"
                        :id="print.id"
                        @update="update = $event"
                        @print="print = $event"
                ></pallet-label-pdf>
            </div>
        </div>
    </div>

</template>

<script>
    import PalletLabelCreate from "./create";
    import PalletLabelUpdate from "./update";
    import PalletLabelList from "./list";
    import PalletLabelPdf from "./pdf";

    export default {
        name: "combine",
        components: {PalletLabelPdf, PalletLabelList, PalletLabelUpdate, PalletLabelCreate},

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
