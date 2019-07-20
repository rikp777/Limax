<template>
    <h1>logout...</h1>
</template>

<script>
    export default {
        name: "auth-logout",
        created() {
            console.log("logout");
            this.$store.dispatch('auth/logout')
                .then(response => {
                    this.$router.push({ name: 'home' })
                })
        }
    }
</script>

