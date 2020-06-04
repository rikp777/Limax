<template>
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block" @click.prevent.stop="changeSideMenuStatus({step :menuClickCount+1,classNames:menuType,selectedMenuHasSubItems})">
                <menu-icon />
            </a>
            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none" @click.prevent.stop="changeSideMenuForMobile(menuType)">
                <mobile-menu-icon />
            </a>
<!--            <div :class="{'search':true, 'mobile-view':isMobileSearch}" ref="searchContainer" @mouseenter="isSearchOver=true" @mouseleave="isSearchOver=false">-->
<!--                <b-input :placeholder="$t('topMenu.search')" @keypress.native.enter="search" v-model="searchKeyword" />-->
<!--                <span class="search-icon" @click="searchClick">-->
<!--                <i class="simple-icon-magnifier"></i>-->
<!--            </span>-->
<!--            </div>-->
            <div class="d-inline-block">
                <change-lang />
            </div>
            <div class="d-inline-block">
                <select-farmer />
            </div>
        </div>
        <router-link class="navbar-logo" tag="a" to="/farmer">

            <img class="logo d-none d-xs-block" src="https://www.limax.nl/images/limax-logo.png" />
<!--            <img class="logo-mobile d-block d-xs-non" src="https://www.limax.nl/images/limax-logo.png" />-->
            <span class="logo d-none d-xs-block"></span>
<!--            <span class="logo-mobile d-block d-xs-none"></span>-->
        </router-link>

        <div class="navbar-right">

           <dark-mode />


            <div class="header-icons d-inline-block align-middle">

                <div class="position-relative d-none d-sm-inline-block">
                    <b-dropdown variant="empty" size="sm" right toggle-class="header-icon" menu-class="position-absolute mt-3 iconMenuDropdown" no-caret>
                        <template slot="button-content">
                            <i class="simple-icon-grid" />
                        </template>

<!--                        <h3 class="text-center font-weight-light" style="color: grey">Panels</h3>-->
<!--                        <b-dropdown-divider/>-->

                        <div v-for="role in authUser.roles">
                            <div v-if="role.id === 1">
                                <router-link tag="a" :to="{ path: '/admin' }" class="icon-menu-item">
                                    <i class="iconsminds-administrator d-block" />
                                    Admin
                                </router-link>
                                <router-link tag="a" :to="{ path: '/farmer' }" class="icon-menu-item">
                                    <i class="iconsminds-tractor d-block" />
                                    Farmer
                                </router-link>
                                <router-link tag="a" :to="{ path: '/planner' }" class="icon-menu-item">
                                    <i class="simple-icon-organization d-block" />
                                    Planner
                                </router-link>
                                <router-link tag="a" :to="{ path: '/production' }" class="icon-menu-item">
                                    <i class="iconsminds-factory d-block" />
                                    Production
                                </router-link>
                                <router-link tag="a" :to="{ path: '/logistics' }" class="icon-menu-item">
                                    <i class="simple-icon-share d-block" />
                                    Logistics
                                </router-link>
                            </div>

                            <div v-if="role.id === 2">
                                <router-link tag="a" :to="{ path: '/admin' }" class="icon-menu-item">
                                    <i class="iconsminds-administrator d-block" />
                                    Moderator
                                </router-link>
<!--                                <router-link tag="a" :to="{ path: '/farmer' }" class="icon-menu-item">-->
<!--                                    <i class="iconsminds-tractor d-block" />-->
<!--                                    Farmer-->
<!--                                </router-link>-->
                                <router-link tag="a" :to="{ path: '/planner' }" class="icon-menu-item">
                                    <i class="simple-icon-organization d-block" />
                                    Planner
                                </router-link>
                                <router-link tag="a" :to="{ path: '/production' }" class="icon-menu-item">
                                    <i class="iconsminds-factory d-block" />
                                    Production
                                </router-link>
                            </div>

                            <div v-if="role.id === 3">
                                <router-link tag="a" :to="{ path: '/farmer' }" class="icon-menu-item">
                                    <i class="iconsminds-tractor d-block" />
                                    Farmer
                                </router-link>
                            </div>

                            <div v-if="role.id === 4">
                                <router-link tag="a" :to="{ path: '/trucker' }" class="icon-menu-item">
                                    <i class="iconsminds-factory d-block" />
                                    Production
                                </router-link>
                            </div>

                            <div v-if="role.id === 5">
                                <router-link tag="a" :to="{ path: '/planner' }" class="icon-menu-item">
                                    <i class="simple-icon-organization d-block" />
                                    Planner
                                </router-link>
                            </div>

                            <div v-if="role.id === 6">
                                <router-link tag="a" :to="{ path: '/production' }" class="icon-menu-item">
                                    <i class="iconsminds-factory d-block" />
                                    Production
                                </router-link>
                            </div>
                        </div>

                    </b-dropdown>
                </div>

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

                <div class="position-relative d-none d-sm-inline-block ">
                    <full-screen />
                </div>

            </div>


            <user-menu :authUser="authUser"/>
        </div>
    </nav>
</template>

<script>
    import jwtService from "../../../common/jwt.service";
    import Switches from 'vue-switches'
    import notifications from '../../../data/notifications'

    import {
        mapGetters,
        mapMutations,
        mapActions
    } from 'vuex'
    import {
        MenuIcon,
        MobileMenuIcon
    } from '../../../components/Svg'
    import {
        searchPath,
        menuHiddenBreakpoint,
        localeOptions,
        buyUrl,
        defaultColor
    } from '../../../constants/config'
    import {
        getDirection,
        setDirection
    } from '../../../utils'
    import UserMenu from "../../../components/menu/UserMenu.vue";
    import DarkMode from "../../../components/menu/DarkMode";
    import FullScreen from "../../../components/menu/FullScreen";
    import ChangeLang from "../../../components/menu/ChangeLang";
    import SelectFarmer from "../../../components/menu/SelectFarmer";
    export default {
        components: {
            SelectFarmer,
            ChangeLang,
            FullScreen,
            DarkMode,
            UserMenu,
            'menu-icon': MenuIcon,
            'mobile-menu-icon': MobileMenuIcon,
        },
        data() {
            return {
                searchKeyword: '',
                isMobileSearch: false,
                isSearchOver: false,
                menuHiddenBreakpoint,
                searchPath,
                buyUrl,
                notifications
            }
        },
        methods: {
            ...mapMutations(['changeSideMenuStatus', 'changeSideMenuForMobile']),
            search() {
                // this.$router.push(`${this.searchPath}?search=${this.searchKeyword}`)
                // this.searchKeyword = ''
            },
            searchClick() {
                if (window.innerWidth < this.menuHiddenBreakpoint) {
                    if (!this.isMobileSearch) {
                        this.isMobileSearch = true
                    } else {
                        this.search()
                        this.isMobileSearch = false
                    }
                } else {
                    this.search()
                }
            },
            handleDocumentforMobileSearch() {
                if (!this.isSearchOver) {
                    this.isMobileSearch = false
                    this.searchKeyword = ''
                }
            },
            getThemeColor() {
                return localStorage.getItem('themeColor') ?
                    localStorage.getItem('themeColor') :
                    defaultColor
            },
        },
        computed: {
            ...mapGetters({
                authUser: 'authUser',
                menuType: 'getMenuType',
                menuClickCount: 'getMenuClickCount',
                selectedMenuHasSubItems: 'getSelectedMenuHasSubItems',
            })
        },
        beforeDestroy() {
            document.removeEventListener('click', this.handleDocumentforMobileSearch)
        },
        created() {
            this.$store.dispatch("getAuthUser");
        },
        watch: {
            '$i18n.locale'(to, from) {
                if (from !== to) {
                    this.$router.go(this.$route.path)
                }
            },
            isMobileSearch(val) {
                if (val) {
                    document.addEventListener('click', this.handleDocumentforMobileSearch)
                } else {
                    document.removeEventListener(
                        'click',
                        this.handleDocumentforMobileSearch
                    )
                }
            }
        }
    }
</script>
