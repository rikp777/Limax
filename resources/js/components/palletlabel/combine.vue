<template>
    <div>
        <div class="row">
            <div class="col">
                <pallet-label-create
                        :updateId=1
                ></pallet-label-create>
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
    import PalletLabelCreate from "./create-update";
    import PalletLabelList from "./list";
    import PalletLabelPdf from "./pdf";

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
