<template>
    <div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';
    export default {
        name: 'palletLabel-read',
        computed: mapState({
            palletLabel: state => state.palletLabel.single
        }),
        methods: {
            ...mapActions('palletLabel',
                [
                    'getById'
                ]
            ),
        },
        mounted() {
            this.getById(this.$route.params.id);
        },

    }
</script>