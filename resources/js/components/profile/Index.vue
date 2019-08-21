<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Profile</h5>
                        <profile-update></profile-update>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Profile</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import ProfileUpdate from "./update";
    export default {
        name: "Index",
        components: {ProfileUpdate}
    }
</script>

<style scoped>

</style>
