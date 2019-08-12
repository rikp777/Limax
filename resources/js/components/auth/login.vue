
<template>
    <div class="login row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">login</div>
                <div class="card-body">
                    <form v-on:submit.prevent="onSubmit(form.email, form.password)" autocomplete="off">
                        <div class="form-group row">
                            <label for="email">Email:</label>
                            <input
                                name="email"
                                id="email"
                                type="email"
                                v-model="form.email"
                                class="form-control"
                                placeholder="Email Address">
                        </div>
                        <div class="form-group row">
                            <label for="password">Password:</label>
                            <input
                                name="password"
                                id="password"
                                type="password"
                                v-model="form.password"
                                class="form-control"
                                placeholder="Password">
                        </div>
                        <div class="form-group row">
                            <input type="submit" value="Login">
                            <router-link v-if="errors" to="authForgot">Forgot?</router-link>
                        </div>
                        <div class="form-group row" v-if="errors">
                            <ul class="error-messages">
                                <li v-for="(v, k) in errors" :key="k">{{ k }} {{ v | error }}</li>
                            </ul>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import { mapState } from 'vuex';

    export default {
        name: "auth-login",
        data(){
            return {
                form: {
                    email: 'admin@limax.nl',
                    password: 'password',
                },
            };
        },
        methods: {
            onSubmit(email, password){
                // throw(this.$store);
                this.$store
                    .dispatch("login", { email, password })
                    .then(() => this.$router.push({ name: "home"}));
            }
        },
        computed: {
            ...mapState({
                errors: state => state.auth.errors
            })
        }
    }
</script>
