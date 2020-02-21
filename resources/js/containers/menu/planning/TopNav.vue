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
        <router-link class="navbar-logo" tag="a" to="/planning">

                        <img class="logo d-none d-xs-block" src="https://www.limax.nl/images/limax-logo.png" />
<!--                        <img class="logo-mobile d-block d-xs-non" src="https://www.limax.nl/images/limax-logo.png" />-->
                        <span class="logo d-none d-xs-block"></span>
<!--                        <span class="logo-mobile d-block d-xs-none"></span>-->
        </router-link>

        <div class="navbar-right">

            <dark-mode />


            <div class="header-icons d-inline-block align-middle">

<!--                <div class="position-relative d-none d-sm-inline-block">-->
<!--                    <b-dropdown variant="empty" size="sm" right toggle-class="header-icon" menu-class="position-absolute mt-3 iconMenuDropdown" no-caret>-->
<!--                        <template slot="button-content">-->
<!--                            <i class="simple-icon-grid" />-->
<!--                        </template>-->
<!--                        <div>-->
<!--                            <router-link tag="a" to="/app/dashboards/default" class="icon-menu-item">-->
<!--                                <i class="iconsminds-shop-4 d-block" />-->
<!--                                {{$t('menu.dashboards')}}-->
<!--                            </router-link>-->
<!--                            <router-link tag="a" to="/app/ui" class="icon-menu-item">-->
<!--                                <i class="iconsminds-pantone d-block" />-->
<!--                                {{$t('menu.ui')}}-->
<!--                            </router-link>-->
<!--                            <router-link tag="a" to="/app/ui/components/charts" class="icon-menu-item">-->
<!--                                <i class="iconsminds-bar-chart-4 d-block" />-->
<!--                                {{$t('menu.charts')}}-->
<!--                            </router-link>-->
<!--                            <router-link tag="a" to="/app/applications/chat" class="icon-menu-item">-->
<!--                                <i class="iconsminds-speach-bubble d-block" />-->
<!--                                {{$t('menu.chat')}}-->
<!--                            </router-link>-->
<!--                            <router-link tag="a" to="/app/applications/survey" class="icon-menu-item">-->
<!--                                <i class="iconsminds-formula d-block" />-->
<!--                                {{$t('menu.survey')}}-->
<!--                            </router-link>-->
<!--                            <router-link tag="a" to="/app/applications/todo" class="icon-menu-item">-->
<!--                                <i class="iconsminds-check d-block" />-->
<!--                                {{$t('menu.todo')}}-->
<!--                            </router-link>-->
<!--                        </div>-->
<!--                    </b-dropdown>-->
<!--                </div>-->
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
            }
        },
        methods: {
            ...mapMutations(['changeSideMenuStatus', 'changeSideMenuForMobile']),
            search() {
                // this.$router.push(`${this.searchPath}?search=${this.searchKeyword}`)
                // this.searchKeyword = ''
            },
            searchClick() {
                // if (window.innerWidth < this.menuHiddenBreakpoint) {
                //     if (!this.isMobileSearch) {
                //         this.isMobileSearch = true
                //     } else {
                //         this.search()
                //         this.isMobileSearch = false
                //     }
                // } else {
                //     this.search()
                // }
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
