<template>
    <div class="login row justify-content-center">
        <div style="
                    background: url('https://www.limax.nl/build/images/color-block.ac4809e9.svg') right bottom fixed;
                    background-size: cover;
                    display: block;
                    height: 100%;
                    width: 100%;
                    position: absolute;
                    top: 0;
                    left: 0;
                    z-index: 1;
                    filter: grayscale(99%);
                    opacity: 0.1;
                "></div>
        <div class="col-md-4 align-self-center" style="
                    position: relative;
                    left: 0px;
                    top: 0px;
                    z-index: 2;
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                ">
            <div class="card">
<!--                <div class="card-header" v-if="error">-->
<!--                </div>-->
                <div class="card-body">
                    <form v-on:submit.prevent="onSubmit(form.email, form.password)" autocomplete="off"
                          class="text-center border border-light p-5">


                        <p class="h3 mb-4"><img src="https://www.limax.nl/images/limax-logo.png" class="img-fluid"></p>
                        <hr>
                        <br>

                        <div class="form-group row" v-if="error">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Unauthorized</strong>, make sure email and password are correct!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>

                        <!-- Email -->
                        <input type="email" id="defaultLoginFormEmail" class="form-control form-control-lg mb-4"
                               v-model="form.email" placeholder="E-mail">

                        <!-- Password -->
                        <input type="password" id="defaultLoginFormPassword" class="form-control form-control-lg mb-4"
                               v-model="form.password" placeholder="Password">

                        <div class="d-flex justify-content-around">
                            <div>
                                <!-- Remember me -->
                                <!--                                <div class="custom-control custom-checkbox" style="font-size: 13px">-->
                                <!--                                    <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">-->
                                <!--                                    <label class="custom-control-label" for="defaultLoginFormRemember">Remember-->
                                <!--                                        me</label>-->
                                <!--                                </div>-->
                            </div>
                            <div>
                                <!-- Forgot password -->
                                <!--                                <a href="" style="color: #F2AB58; font-size: 13px">Forgot password?</a>-->
                            </div>
                        </div>

                        <!-- Sign in button -->
                        <button class="btn btn-primary btn-block my-4 text-white" type="submit" value="Login">Sign in
                        </button>
                        <!--                        <div class="form-group row" v-if="errors">-->
                        <!--                            <ul class="error-messages">-->
                        <!--                                <li v-for="(v, k) in errors" :key="k">{{ k }} {{ v | error }}</li>-->
                        <!--                            </ul>-->
                        <!--                        </div>-->
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import {mapState, mapGetters} from 'vuex';

    export default {
        name: "auth-login",
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                },
            };
        },
        methods: {
            onSubmit(email, password) {
                // throw(this.$store);

                this.$store.dispatch("login", {email, password})
                    .then(() => this.$router.push({name: "home"}));
            }
        },
        computed: {
            ...mapState({
                errors: state => state.auth.errors
            }),
            error() {
                return this.$store.getters.errors
            },
        }
    }
</script>
