<template>
    <div>
        <div class="row">
            <div class="col">
                <shipping-label-create
                        v-if="!update.update && !print.print"
                        @print="print = $event"
                ></shipping-label-create>
<!--                <shipping-label-update-->
<!--                        v-if="update.update && print.print"-->
<!--                        @print="print = $event"-->
<!--                ></shipping-label-update>-->
            </div>
            <div class="col">
<!--                <shipping-label-list-->
<!--                        v-if="!print.print"-->
<!--                        @update="update = $event"-->
<!--                        @print="print = $event"-->
<!--                ></shipping-label-list>-->
            </div>
        </div>
    </div>

</template>

<script>
    import ShippingLabelCreate from "./create";
    import ShippingLabelUpdate from "./update";
    import ShippingLabelList from "./list";
    import ShippingLabelPdf from "./pdf";

    export default {
        name: "combine",
        components: {ShippingLabelPdf, ShippingLabelList, ShippingLabelUpdate, ShippingLabelCreate},

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
