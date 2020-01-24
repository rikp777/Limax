<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Planning</h5>
                        <planning-update></planning-update>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import PlanningUpdate from "./update";

    export default {
        name: "Index",
        components: {PlanningUpdate},
        props: ['farmers'],
    }
</script>

<style scoped>

</style>
