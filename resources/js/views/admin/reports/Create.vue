<template>
    <b-row>
        <b-colxx xl="7" lg="12" class="mb-4">
            <div v-if="!update">
            <user-create />
            </div>
            <div v-else>
                <user-update
                    :id="userId"
                    @createMode="createListener"
                />
            </div>
        </b-colxx>
        <b-colxx xl="5" lg="12" class="mb-4">
            <b-card :title="$t('user.attributes.list.title')">
            <user-list
                @updateMode="updateListener"
            />
            </b-card>
        </b-colxx>
    </b-row>
</template>

<script>
    import userCreate from "../../../components/crudl/user/userCreate";
    import userUpdate from "../../../components/crudl/user/UserUpdate.component";
    import userList from "../../../components/crudl/user/userList";
    export default {
        data () {
            return {
                update: false,
                userId: null
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
            }
        }
    }
</script>

<style scoped>

</style>
