<template>
    <b-row>
        <b-colxx xl="7" lg="12" class="mb-4">
            <div v-if="!update">
                <user-create @refreshMode="refreshListener"/>
            </div>
            <div v-else>
                <user-update
                    :id="userId"
                    @createMode="createListener"
                    @refreshMode="refreshListener"
                />
            </div>
        </b-colxx>
        <b-colxx xl="5" lg="12" class="mb-4">
            <b-card :title="$t('user.attributes.list.title')">
                <user-list :key="reloadComp"
                           @updateMode="updateListener"
                           @refreshMode="refreshListener"
                />
            </b-card>
        </b-colxx>
    </b-row>
</template>

<script>
    import userCreate from "../../../components/crudl/user/userCreate";
    import userUpdate from "../../../components/crudl/user/userUpdate";
    import userList from "../../../components/crudl/user/userList";

    export default {
        data() {
            return {
                update: false,
                userId: null,
                reloadComp: 0,
            }
        },
        components: {
            userCreate,
            userUpdate,
            userList
        },
        methods: {
            updateListener(id) {
                console.log('update: ' + id)
                this.userId = id
                this.update = true
            },
            createListener() {
                console.log('create')
                this.update = false
            },
            refreshListener() {
                this.reloadComp += 1
            }
        }
    }
</script>

<style scoped>

</style>
