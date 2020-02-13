<template>
    <div class="header-icons d-inline-block align-middle">
        <div class="position-relative d-inline-block">
            <b-dropdown variant="empty" size="sm" right toggle-class="header-icon notificationButton" menu-class="position-absolute mt-3 notificationDropdown" no-caret>
                <template slot="button-content">
                    <i class="simple-icon-bell" />
                    <span class="count">1</span>
                </template>
                <vue-perfect-scrollbar :settings="{ suppressScrollX: true, wheelPropagation: false }">
                    <div class="d-flex flex-row mb-3 pb-3 border-bottom" v-for="(n,index) in notifications" :key="index">
<!--                        <router-link tag="a" to="/app/pages/product/details">-->
<!--                            <img :src="n.img" :alt="n.title" class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />-->
<!--                        </router-link>-->
                        <div class="pl-3 pr-2 text-secondary">
                                <p class="font-weight-medium mb-1">{{n.title}}</p>
                                <p class="text-muted mb-0 text-small">{{n.date}}</p>
                        </div>
                    </div>
                </vue-perfect-scrollbar>
            </b-dropdown>
        </div>

        <div class="user d-inline-block">
        <b-dropdown class="dropdown-menu-right" right variant="empty" toggle-class="p-0" menu-class="mt-3" no-caret>
            <template slot="button-content">
                <span class="name mr-1 text-secondary">{{authUser.fullName}}</span>
                <span>
                        <img :alt="authUser.fullName"
                             src="https://cdn.discordapp.com/attachments/490497757098803200/672062989251117066/486846866412011561.png"/>
                    </span>
            </template>
<!--            <b-dropdown-item>Account</b-dropdown-item>-->
<!--            <b-dropdown-item>Features</b-dropdown-item>-->
<!--            <b-dropdown-item>History</b-dropdown-item>-->
<!--            <b-dropdown-item>Support</b-dropdown-item>-->
<!--            <b-dropdown-divider/>-->
            <b-dropdown-item @click="logout">Sign out</b-dropdown-item>
        </b-dropdown>
    </div>
    </div>
</template>

<script>
    import notifications from '../../data/notifications'

    export default {
        props: ['authUser'],
        data() {
            return {
                notifications
            }
        },
        methods: {
            logout() {
                this.$router.push({name: "logout"})
            },
        }
    }
</script>
