<template>
    <div>
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
                <tr v-for="palletlabel in palletLabels" :key="palletlabel.id">
                    <td> {{ palletlabel.id}}</td>
                    <td> {{ palletlabel.article_id}}</td>
                    <td>
                        <router-link :to="{ name: 'palletLabelUpdate', params: { id: palletlabel.id }}">Update</router-link>
                        <router-link :to="{ name: 'palletLabelPdf', params: { id: palletlabel.id }}">PDF</router-link>
                        <router-link :to="{ name: 'palletLabelRead', params: { id: palletlabel.id }}">View</router-link>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>

    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        name: "Home",
        computed: {
            palletLabels(){
                return this.$store.getters.palletLabels
            },
            isLoading(){
                return this.$store.getters.palletLabelIsLoading
            }
        },
        mounted() {
            this.getAllPalletLabels();
        },
        methods: {
            getAllPalletLabels(){
                this.$store.dispatch("getAllPalletLabels");
            }
        }
    }
</script>


