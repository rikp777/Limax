<template>
    <div>
        <div class="btn-wrapper">
            <router-link to="/users/create" class="btn btn-primary btn-sm">Create</router-link>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <template v-if="!palletLabels">
                <tr>
                    <td colspan="4" class="text-center">No pallet labels Available</td>
                </tr>
            </template>
            <template v-else>
                <tr v-for="palletlabel in palletLabels.data" :key="palletlabel.id">
                    <td> {{ palletlabel.id}}</td>
                    <td> {{ palletlabel.article_id}}</td>
                    <td>
                        <router-link :to="{ name: 'palletLabelRead', params: { id: palletlabel.id }}">View</router-link>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';
    export default {
        name: 'palletLabel-list',
        computed: mapState({
                palletLabels: state => state.palletLabel.all,
        }),
        methods: {
            ...mapActions('palletLabel',
                [
                    'getAll'
                ]
            ),
        },
        mounted() {
            if(this.palletLabels.length){
                return;
            }
            this.getAll();
        },

    }
</script>


