<template>
    <b-dropdown id="langddm" class="ml-2" variant="light" size="sm" toggle-class="language-button">
        <template slot="button-content">
            <span class="name">{{$i18n.locale.toUpperCase()}}</span>
        </template>
        <b-dropdown-item v-for="(l,index) in localeOptions" :key="index" @click="changeLocale(l.id)">{{l.name}}</b-dropdown-item>
    </b-dropdown>
</template>

<script>
    import {mapActions} from "vuex";
    import {
        localeOptions,
    } from '../../constants/config'
    export default {
        name: "ChangeLang",
        data() {
            return {
                localeOptions
            }
        },
        methods: {
            ...mapActions(['setLang']),
            changeLocale(locale) {
                this.setLang(locale)
            },
        }
    }
</script>

<style scoped>

</style>
