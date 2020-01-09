<template>
    <h1>logout...</h1>
</template>

<script>
    export default {
        name: "auth-logout",
        created() {
            this.$store.dispatch('logout')
                .then(response => {
                    this.$router.push({ name: 'home' })
                });
        }
    }
</script>

