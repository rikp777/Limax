<template>
    <div class="d-none d-md-inline-block align-middle mr-3">
        <switches id="tool-mode-switch" v-model="isDarkActive" theme="custom" class="vue-switcher-small" color="primary" />
        <b-tooltip target="tool-mode-switch" placement="left" title="Dark Mode"></b-tooltip>
    </div>
</template>

<script>
    import {defaultColor} from "../../constants/config";
    import Switches from "vue-switches";

    export default {
        name: "DarkMode",
        components: {
            'switches': Switches
        },
        data() {
            return {
                isDarkActive: false
            }
        },
        methods: {
            getThemeColor() {
                return localStorage.getItem('themeColor') ?
                    localStorage.getItem('themeColor') :
                    defaultColor
            },
        },
        created() {
            const color = this.getThemeColor();
            this.isDarkActive = color.indexOf('dark') > -1
        },
        watch: {
            isDarkActive(val) {
                let color = this.getThemeColor();
                let isChange = false;
                if (val && color.indexOf('light') > -1) {
                    isChange = true;
                    color = color.replace('light', 'dark')
                } else if (!val && color.indexOf('dark') > -1) {
                    isChange = true;
                    color = color.replace('dark', 'light')
                }
                if (isChange) {
                    localStorage.setItem('themeColor', color)
                    setTimeout(() => {
                        window.location.reload()
                    }, 500)
                }
            },
        }
    }
</script>
