<template>
    <b-row class="h-100">
        <b-colxx xxs="12" md="10" class="mx-auto my-auto">
            <b-card class="auth-card" no-body>
                <div class="position-relative image-side">
                    <p class="text-white h2">{{ $t('auth.intro.title') }}</p>
                    <p class="white mb-0">
                        {{ $t('auth.intro.text') }}
                    </p>
                </div>
                <div class="form-side">
                    <router-link tag="a" to="/">
                        <div class="logo-single">
                            <img src="https://www.limax.nl/images/limax-logo.png" />
                        </div>
                    </router-link>
                    <h6 class="mb-4">{{ $t('auth.login.title')}}</h6>

                    <b-alert show dismissible variant="danger" data-test=error v-if="errorLog">{{errorLog}}</b-alert>

                    <b-form @submit.prevent="formSubmit" class="av-tooltip tooltip-label-bottom">
                        <b-form-group :label="$t('user.attributes.email.title')" class="has-float-label mb-4">
                            <b-form-input type="text" data-test="email" v-model="form.email"/>
<!--                            <b-form-invalid-feedback v-if="!$v.form.email.required">{{ $t('user.email.validation.notEntered')}}</b-form-invalid-feedback>-->
<!--                            <b-form-invalid-feedback v-else-if="!$v.form.email.email">{{ $t('user.email.validation.notValid')}}</b-form-invalid-feedback>-->
<!--                            <b-form-invalid-feedback v-else-if="!$v.form.email.minLength">{{ $t('user.email.validation.minLength')}}</b-form-invalid-feedback>-->
                        </b-form-group>

                        <b-form-group :label="$t('user.attributes.password.title')" class="has-float-label mb-4">
                            <b-form-input type="password" data-test="password" v-model="form.password" />
<!--                            <b-form-invalid-feedback v-if="!$v.form.password.required">{{ $t('user.password.validation.notEntered')}}</b-form-invalid-feedback>-->
<!--                            <b-form-invalid-feedback v-else-if="!$v.form.password.minLength || !$v.form.password.maxLength">{{ $t('user.password.validation.minLength')}}</b-form-invalid-feedback>-->
                        </b-form-group>
                        <div class="d-flex justify-content-between align-items-center">
<!--                            <router-link tag="a" to="/user/forgot-password">{{ $t('auth.login.forgot')}}</router-link>-->
                            <div></div>
                            <b-button
                                type="submit"
                                variant="primary"
                                size="lg"
                                :class="{'btn-multiple-state btn-shadow': true,
                                            'show-success': !processing && loginError===false,
                                            'show-fail': !processing && loginError
                                }">
<!--                                <b-button-->
<!--                                    type="submit"-->
<!--                                    variant="primary"-->
<!--                                    size="lg"-->
<!--                                    :disabled="processing"-->
<!--                                    :class="{'btn-multiple-state btn-shadow': true,-->
<!--                                            'show-spinner': processing,-->
<!--                                            'show-success': !processing && loginError===false,-->
<!--                                            'show-fail': !processing && loginError-->
<!--                                }">-->
                            <span class="spinner d-inline-block">
                                <span class="bounce1"/>
                                <span class="bounce2"/>
                                <span class="bounce3"/>
                            </span>
                                <span class="icon success">
                                <i class="simple-icon-check"/>
                            </span>
                                <span class="icon fail">
                                <i class="simple-icon-exclamation"/>
                            </span>
                                <span class="label">{{ $t('auth.login.loginButton') }}</span>
                            </b-button>
                        </div>
                    </b-form>
                </div>
            </b-card>
        </b-colxx>
    </b-row>
</template>

<script>
    /*
    TODO
    #Bug login button delete state

     */
    import {
        mapGetters,
        mapActions
    } from "vuex"
    export default {
        name: "Login.vue",
        data() {
            return {
                form: {
                    email: null,
                    password: null
                },
                errorLog: null
            }
        },
        computed: {
            ...mapGetters(["isAuthenticated", "authUser", "processing", "loginError"])
        },
        methods: {
            ...mapActions(["login"]),
            formSubmit(){
                this.check()
            },
            check(){
                this.login({
                    email: this.form.email,
                    password: this.form.password
                }).then(() => {
                    // console.log(this.authUser.roles[0].name);

                    // IF NEW ROLE ADD HERE!

                    if(this.authUser.roles[0].name === "Admin"){
                        this.$router.push({ path: "/admin"})
                    }
                    if(this.authUser.roles[0].name === "Moderator"){
                        this.$router.push({ path: "/admin"})
                    }
                    if(this.authUser.roles[0].name === "Planning"){
                        this.$router.push({ path: "/planner"})
                    }
                    if(this.authUser.roles[0].name === "Production"){
                        this.$router.push({ path: "/production"})
                    }
                    if(this.authUser.roles[0].name === "Farmer"){
                        this.$router.push({ path: "/farmer"})
                    }
                    if(this.authUser.roles[0].name === "Logistics"){
                        this.$router.push({ path: "/logistics"})
                    }
                    if(this.authUser.roles[0].name === "Trucker"){
                        this.$router.push({ path: "/trucker"})
                    }
                    // else {
                    //     this.$router.push({ path: "/farmer"})
                    // }

                })
            }
        },
        watch: {
            loginError(val){
                if(val != null) {
                    console.log(val);
                    this.form.email = null;
                    this.form.password = null;
                    this.errorLog = "Something went wrong, try again!"
                    // this.$swal({
                    //     position: 'top-end',
                    //     icon: 'error',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                    // this.$notify("error", "Login Error", val, {
                    //     duration: 3000,
                    //     permanent: false
                    // });
                }
            },
        }
    }
</script>
