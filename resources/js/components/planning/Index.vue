<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Planning</h5>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
        name: "planning-index",
    }
</script>

<style scoped>

</style>
