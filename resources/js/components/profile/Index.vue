<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profile</h5>
                <profile-update></profile-update>
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
