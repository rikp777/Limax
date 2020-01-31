<template>
    <div class="btn-group">
        <b-button variant="empty" class="header-icon btn-sm" @click="toggleFullScreen">
            <i :class="{'d-inline-block':true,'simple-icon-size-actual':fullScreen,'simple-icon-size-fullscreen':!fullScreen }" />
        </b-button>
    </div>
</template>

<script>
    export default {
        name: "FullScreen",
        data() {
            return {
                fullScreen: false,
            }
        },
        methods: {
            toggleFullScreen() {
                const isInFullScreen = this.isInFullScreen()

                var docElm = document.documentElement
                if (!isInFullScreen) {
                    if (docElm.requestFullscreen) {
                        docElm.requestFullscreen()
                    } else if (docElm.mozRequestFullScreen) {
                        docElm.mozRequestFullScreen()
                    } else if (docElm.webkitRequestFullScreen) {
                        docElm.webkitRequestFullScreen()
                    } else if (docElm.msRequestFullscreen) {
                        docElm.msRequestFullscreen()
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen()
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen()
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen()
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen()
                    }
                }
                this.fullScreen = !isInFullScreen
            },
            isInFullScreen() {
                return (
                    (document.fullscreenElement && document.fullscreenElement !== null) ||
                    (document.webkitFullscreenElement &&
                        document.webkitFullscreenElement !== null) ||
                    (document.mozFullScreenElement &&
                        document.mozFullScreenElement !== null) ||
                    (document.msFullscreenElement && document.msFullscreenElement !== null)
                )
            },
        }
    }
</script>

<style scoped>

</style>
