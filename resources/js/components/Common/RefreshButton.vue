<template>
    <div class="position-absolute card-top-buttons">
        <button class="btn btn-header-light icon-button" @click="$emit('click')">
            <i class="simple-icon-refresh" />
        </button>
    </div>
</template>

<script>
    export default {
        name: "RefreshButton"
    }
</script>

<style scoped>

</style>
