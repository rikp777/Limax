<template>
    <div class="user-create">
        <form @submit.prevent="add">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td>
                        <input type="text" class="form-control" v-model="user.name" placeholder="User Name">
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="email" class="form-control" v-model="user.email" placeholder="User Email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <router-link to="/users" class="btn">Cancel</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Create" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <div class="errors" v-if="errors">
            <ul>
                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                    <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';
    export default {
        name: "user-create",
        data() {
            return {
                user: {
                    name: '',
                    email: ''
                },
                errors: null
            }
        },
        computed:{
            authUser() {
                return this.$store.getters.authUser;
            }
        },
        methods: {
            add() {
                this.errors = null;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.user, constraints);

                if(errors){
                    this.errors = errors;
                    return;
                }

                axios.post('/api/user/', this.$data.user)
                    .then((response) => {
                        this.$router.push('users');
                    })

                // send user data to api
            },
            getConstraints() {
                return {
                    name: {
                        presense: true,
                        length: {
                            minimum: 3,
                            message: 'Must be at least 3 characters long'
                        }
                    },
                    email: {
                        presense: true,
                        email: true
                    },
                };
            }
        }
    }
</script>

<style scoped>
    .errors {
        background: lightcoral;
        border-radius: 5px;
        padding: 21px 0, ;
    }
</style>