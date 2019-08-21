<template>
    <form class="needs-validation" novalidate>
        <div class="row">
            <div class="col-auto">
                <img :src="authUser.photo" class="rounded img-lg m-5">
            </div>
            <div class="col">
                <div class="form-row">
                    <div class="col mb-3">
                        <label for="validationTooltip01">First name</label>
                        <input type="text" class="form-control" id="validationTooltip01" placeholder="First name" v-model="authUser.firstName" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col mb-3">
                        <label for="validationTooltip02">Last name</label>
                        <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name" v-model="authUser.lastName" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col mb-3">
                        <label for="validationTooltipUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                            </div>
                            <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required v-model="authUser.email">
                            <div class="invalid-tooltip">
                                Please choose a unique and valid username.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
</template>

<script>
    import {mapGetters} from 'vuex';
    export default {
        name: "profile-update",
        computed: {
            ...mapGetters(["authUser", "isAuthenticated"])
        }
    }
</script>

<style scoped>

</style>
