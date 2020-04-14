<template>
    <b-card :title="$t('user.title')" style="border-left: 6px solid #f28125">
        <validation-observer ref="observer" v-slot="{ invalid }">
            <b-form @submit.prevent="validateBeforeSubmit">

                <validation-provider
                    :name="$t('user.attributes.firstname.title')"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                >
                    <label class="form-group has-float-label mb-4">
                        <input type="text" class="form-control" v-model="user.firstName" id="firstName" name="firstName"
                               :state="getValidationState(validationContext)"
                               aria-describedby="firstName-live-feedback">
                        <span>{{ $t('user.attributes.firstname.title') }}</span>
                    </label>
                    <b-form-invalid-feedback id="firstName-live-feedback">{{ validationContext.errors[0] }}
                    </b-form-invalid-feedback>
                </validation-provider>

                <validation-provider
                    :name="$t('user.attributes.lastname.title')"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                >
                    <label class="form-group has-float-label mb-4">
                        <input type="text" class="form-control" v-model="user.lastName" id="lastName" name="lastName"
                               :state="getValidationState(validationContext)" aria-describedby="lastName-live-feedback">
                        <span>{{ $t('user.attributes.lastname.title') }}</span>
                    </label>
                    <b-form-invalid-feedback id="lastName-live-feedback">{{ validationContext.errors[0] }}
                    </b-form-invalid-feedback>
                </validation-provider>


                <validation-provider
                    :name="$t('user.attributes.email.title')"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                >
                    <label class="form-group has-float-label mb-4">
                        <input type="email" class="form-control" v-model="user.email" id="email" name="email"
                               :state="getValidationState(validationContext)" aria-describedby="email-live-feedback">
                        <span>{{ $t('user.attributes.email.title') }}</span>
                    </label>
                    <b-form-invalid-feedback id="email-live-feedback">{{ validationContext.errors[0] }}
                    </b-form-invalid-feedback>
                </validation-provider>


                <validation-provider
                    :name="$t('user.attributes.password.title')"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                >
                    <label class="form-group has-float-label mb-4">
                        <input type="password" class="form-control" v-model="user.password" id="password"
                               name="password" :state="getValidationState(validationContext)"
                               aria-describedby="password-live-feedback">
                        <span>{{ $t('user.attributes.password.title') }}</span>
                    </label>
                    <b-form-invalid-feedback id="password-live-feedback">{{ validationContext.errors[0] }}
                    </b-form-invalid-feedback>
                </validation-provider>

<!--                <div class="separator mb-5"/>-->

                <h4>{{$t('user.actions.title')}}</h4>
                <br>

                <validation-provider
                    :name="$t('user.attributes.role.title')"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                >
                    <label class="form-group has-float-label mb-4">
                        <multiselect v-model="user.roles" :options="roles" :multiple="false"
                                     :close-on-select="true" :clear-on-select="false" :preserve-search="true"
                                     placeholder="Select role" label="name" track-by="name"
                                     :preselect-first="false">
                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} role(s) selected</span>
                            </template>
                        </multiselect>
                        <span>{{ $t('user.attributes.roles.title') }}</span>
                    </label>
                    <b-form-invalid-feedback id="password-live-feedback">{{ validationContext.errors[0] }}
                    </b-form-invalid-feedback>
                </validation-provider>

                <validation-provider
                    :name="$t('user.attributes.departments.title')"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                >
                    <label class="form-group has-float-label mb-4">
                        <multiselect v-model="user.departments" :options="departments" :multiple="true"
                                     :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                                     placeholder="Select department" label="name" track-by="name"
                                     :preselect-first="false">
                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} department(s) selected</span>
                            </template>
                        </multiselect>
                        <span>{{ $t('user.attributes.departments.title') }}</span>
                    </label>
                    <b-form-invalid-feedback id="password-live-feedback">{{ validationContext.errors[0] }}
                    </b-form-invalid-feedback>
                </validation-provider>

                <validation-provider
                    :name="$t('user.attributes.farmers.title')"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                >
                    <label class="form-group has-float-label mb-4">
                        <multiselect v-model="user.farmers" :options="farmers" :multiple="true"
                                     :close-on-select="false" :clear-on-select="false" :preserve-search="false"
                                     placeholder="Select farmers" label="name" track-by="name"
                                     :preselect-first="false">
                            <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} farmer(s) selected</span>
                            </template>
                        </multiselect>
                        <span>{{ $t('user.attributes.farmers.title') }}</span>
                    </label>
                    <b-form-invalid-feedback id="password-live-feedback">{{ validationContext.errors[0] }}
                    </b-form-invalid-feedback>
                </validation-provider>


                <div class="d-flex justify-content-end align-items-center">
                    <b-button type="submit" variant="primary" size="lg" class="btn-shadow" :disabled="invalid">{{
                        $t('user.actions.buttonRegister')}}
                    </b-button>
                </div>
            </b-form>
        </validation-observer>
    </b-card>
</template>

<script>
    export default {
        /*
          TODO

           Hier kan een User worden aangemaakt

         *De User kan worden gekoppeld aan een of meerdere Farmers *optioneel*
         *De User kan worden gekoppeld aan een of meerdere Rights
         *De User kan worden gekoppeld aan een of meerdere Departments

           */
        name: "UserCreate",
        data() {
            return {
                user: {
                    email: '',
                    firstName: '',
                    lastName: '',
                    password: '',
                    roles: [],
                    departments: [],
                    farmers: [],
                },
                serverErrors: '',
            }
        },
        computed: {
            authUser() {
                return this.$store.getters.authUser;
            },
            roles() {
                return this.$store.getters.roles;
            },
            farmers() {
                return this.$store.getters.farmers;
            },
            departments() {
                return this.$store.getters.departments;
            },
        },
        methods: {
            getValidationState({dirty, validated, valid = null}) {
                return dirty || validated ? valid : null;
            },
            validateBeforeSubmit() {
                this.create();
            },
            create() {
                this.$store.dispatch('createUser', {
                    email: this.user.email,
                    first_name: this.user.firstName,
                    last_name: this.user.lastName,
                    password: this.user.password,
                    roles: this.user.roles,
                    departments: this.user.departments,
                    farmers: this.user.farmers
                }).then(response => {
                    // this.$router.push({ name: 'userList'})
                    this.$emit('refreshMode');
                        this.user.email = '';
                        this.user.firstName = '';
                        this.user.lastName = '';
                        this.user.password = '';
                        this.user.roles = [];
                        this.user.departments = [];
                        this.user.farmers = [];
                })
            },
            getAllRoles() {
                this.$store.dispatch("getAllRoles");
            },
            getAllFarmers() {
                this.$store.dispatch("getAllFarmers");
            },
            getAllDepartments() {
                this.$store.dispatch("getAllDepartments");
            }
        },
        mounted() {
            Promise.all([
                this.getAllRoles(),
                this.getAllFarmers(),
                this.getAllDepartments(),
            ]).finally(() => {
                //console.log(" nu ben ik klaar");
            })
        },
    }
</script>

<style scoped>

</style>
