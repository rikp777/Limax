<template>
    <div class="card-body">
        <form @submit.prevent="validateBeforeSubmit">
            <div class="row">
<!--                <div class="col-auto">-->
<!--                    <img :src="authUser.photo" class="rounded img-lg m-5">-->
<!--                </div>-->
                <!--            {{user}}-->
                <!--            {{farmers}}-->
                <!--            {{departments}}-->
                <div class="col">
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="validationTooltip01">First name</label>
                            <input type="text" class="form-control" id="validationTooltip01"
                                   :placeholder="user.firstName" v-model="form.firstName" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label for="validationTooltip02">Last name</label>
                            <input type="text" class="form-control" id="validationTooltip02"
                                   :placeholder="user.lastName" v-model="form.lastName" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="validationTooltipUsername">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                </div>
                                <input type="text" class="form-control" id="validationTooltipUsername"
                                       :placeholder="user.email" aria-describedby="validationTooltipUsernamePrepend"
                                       required v-model="form.email">
                                <div class="invalid-tooltip">
                                    Please choose a unique and valid username.
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label>Roles</label>
                            <div>
                                <multiselect v-model="form.roles" :options="roles" :multiple="false"
                                             :close-on-select="true" :clear-on-select="false" :preserve-search="true"
                                             placeholder="Select role" label="name" track-by="name"
                                             :preselect-first="true">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                        class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} role(s) selected</span>
                                    </template>
                                </multiselect>
                                <!--                                <pre class="language-json"><code>{{ form.roles  }}</code></pre>-->
                            </div>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label>Departments</label>
                            <div>
                                <multiselect v-model="form.departments" :options="departments" :multiple="true"
                                             :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                                             placeholder="Select department" label="name" track-by="name"
                                             :preselect-first="true">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                        class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} department(s) selected</span>
                                    </template>
                                </multiselect>
                                <!--                            <pre class="language-json"><code>{{ form.departments  }}</code></pre>-->
                            </div>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label>Farmers</label>
                            <div>
                                <multiselect v-model="form.farmers" :options="farmers" :multiple="true"
                                             :close-on-select="false" :clear-on-select="false" :preserve-search="false"
                                             placeholder="Select farmers" label="name" track-by="name"
                                             :preselect-first="true">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                        class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} farmer(s) selected</span>
                                    </template>
                                </multiselect>
                                <!--                            <pre class="language-json"><code>{{ form.departments  }}</code></pre>-->
                            </div>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <router-link :to="{ name: 'userList' }" class="btn btn-primary text-white">Back to all users</router-link>
            <button type="button" class="btn btn-primary text-white" @click="validateBeforeSubmit">Update</button>
        </form>
    </div>

</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: "user-read",
        data() {
            return {
                form: {
                    id: '',
                    firstName: '',
                    lastName: '',
                    email: '',
                    roles: [],
                    departments: [],
                    farmers: [],
                },
            }
        },

        computed: {
            ...mapGetters(["authUser", "isAuthenticated"]),
            user() {
                return this.$store.getters.user;
            },
            farmers() {
                return this.$store.getters.farmers;
            },
            departments() {
                return this.$store.getters.departments;
            },
            roles() {
                return this.$store.getters.roles;
            },
            // trucks() {
            //     return this.$store.getters.trucks;
            // },
        },
        methods: {
            getUser(id) {
                this.$store.dispatch("getUser", id)
            },
            getAllRoles() {
                this.$store.dispatch("getAllRoles");
            },
            getAllFarmers() {
                this.$store.dispatch("getAllFarmers");
            },
            getAllDepartments() {
                this.$store.dispatch("getAllDepartments");
            },
            // getAllTrucks() {
            //     this.$store.dispatch("getAllTrucks");
            // },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$store.dispatch("updateUser", this.form)
                            .then(() => {
                                this.$router.push({name: 'userList'})
                            });
                    }
                })
            },
        },
        mounted() {
            Promise.all([
                this.getAllRoles(),
                this.getAllFarmers(),
                this.getAllDepartments(),
                // this.getAllTrucks(),
                this.$store.dispatch("getUser", this.$route.params.id).then(() => {
                    this.form.id = this.user.id;
                    this.form.firstName = this.user.firstName;
                    this.form.lastName = this.user.lastName;
                    this.form.email = this.user.email;
                    this.form.roles = this.user.roles[0];
                    // console.log(this.user.roles[0]);
                    this.form.departments = this.user.departments;
                    this.form.farmers = this.user.farmers;
                })
            ]).finally(() => {
                // console.log(" nu ben ik klaar");
            })
        },
    }
</script>

<style scoped>
    .user-read {
        display: flex;
        align-items: center;
    }

    .user-img {
        flex: 1;
    }

    .user-img img {
        max-width: 160px;
    }

    .user-info {
        flex: 3;
        overflow: scroll;
    }
</style>
