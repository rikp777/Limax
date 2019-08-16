<template>
    <div class="card">
        <div class="card-body">




            <form @submit.prevent="validateBeforeSubmit">
                <div v-if="serverErrors" class="alert alert-warning" role="alert">
                    <div v-for="(value, key) in serverErrors" :key="key">{{ value[0] }}</div>
                </div>

                <div class="form-row">
                    <div class="col mb-3">
                        <label for="email">Email</label>
                        <input
                                type="text"
                                name="email"
                                id="email"
                                v-model="user.email"
                                v-validate="'required|email'"
                                :class="{ 'is-invalid': errors.has('email') }"
                                class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('email') }}</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col mb-3">
                        <label for="firstName">First name</label>
                        <input
                                type="text"
                                name="firstName"
                                id="firstName"
                                v-model="user.firstName"
                                v-validate="'required'"
                                :class="{ 'is-invalid': errors.has('firstName') }"
                                class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('firstName') }}</span>
                    </div>
                    <div class="col mb-3">
                        <label for="lastName">Last name</label>
                        <input
                                type="text"
                                name="lastName"
                                id="lastName"
                                v-model="user.lastName"
                                v-validate="'required'"
                                :class="{ 'is-invalid': errors.has('lastName') }"
                                class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('lastName') }}</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col mb-3">
                        <label for="password">Password</label>
                        <input
                                type="text"
                                name="password"
                                id="password"
                                v-model="user.password"
                                v-validate="'required'"
                                :class="{ 'is-invalid': errors.has('password') }"
                                class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('password') }}</span>
                    </div>
                </div>


                <button class="btn btn-primary" type="submit">Create</button>
            </form>
            <form>

            </form>



        </div>
    </div>
</template>

<script>
    export default {
        name: "user-create",
        data() {
            return {
                user: {
                    email: '',
                    firstName: '',
                    lastName: '',
                    password: '',
                },
                serverErrors: '',
            }
        },
        computed:{
            authUser() {
                return this.$store.getters.authUser;
            },
        },
        methods: {
            validateBeforeSubmit(){
                this.$validator.validateAll().then((result) => {
                    if(result) {
                        this.Create();
                    }
                })
            },
            create() {
                this.$store.dispatch('user/create', {
                    email: this.user.email,
                    first_name: this.user.firstName,
                    last_name: this.user.lastName,
                    password: this.user.password,
                }).then(response => {
                    this.$router.push({ name: 'userList'})
                }).catch(error => {
                    console.log(error.response.data.errors);
                    this.serverErrors = Object.values(error.response.data.errors)
                })
            }
        }
    }
</script>
