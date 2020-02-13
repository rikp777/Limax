<template>
    <div>

        <h6>{{$t('cell.main.title')}}</h6>
        <hr>
        <b-row>
            <b-colxx xl="6" lg="12" class="mb-4">
                <b-card :title="$t('cell.create.title')" style="border-left: 6px solid #f28125" v-if="!update">
                    <farmer-cell-create
                        @reloadMode="reloadListenerCel"
                    />
                </b-card>
                <b-card :title="$t('cell.update.title') + ' ' + this.cellId" style="border-left: 6px solid red" v-else>
                    <farmer-cell-update
                        :id="cellId"
                        @createMode="createListener"
                        @reloadMode="reloadListenerCel"
                    />
                </b-card>
            </b-colxx>
            <b-colxx xl="6" lg="12" class="mb-4">
                <b-card :title="$t('cell.list.title')">
                    <farmer-cell-list :key="reloadCompCel"
                                      @updateMode="updateListener"
                                      @refreshMode="reloadListenerCel"
                    />
                </b-card>
            </b-colxx>
        </b-row>


        <h6>{{$t('article.main.title')}}</h6>
        <hr>
        <b-row>
            <b-colxx xl="6" lg="12" class="mb-4">
                <b-card :title="$t('article.connect.title')" style="border-left: 6px solid #f28125">
                    <farmer-article-connect @reloadMode="reloadListenerArticle"/>
                </b-card>
            </b-colxx>
            <b-colxx xl="6" lg="12" class="mb-4">
                <b-card :title="$t('article.list.title')">
                    <farmer-article-list :key="reloadCompArticle"
                                         @refreshMode="reloadListenerArticle"
                    />
                </b-card>
            </b-colxx>
            <!--            <b-colxx xl="6" lg="12" class="mb-4">-->
            <!--                <b-card :title="$t('article.create.title')">-->
            <!--                    <farmer-article-list />-->
            <!--                </b-card>-->
            <!--            </b-colxx>-->
        </b-row>

    </div>
</template>

<script>
    import FarmerCellCreate from "../../../components/crudl/farmer/FarmerCellCreate";
    import FarmerCellUpdate from "../../../components/crudl/farmer/FarmerCellUpdate";
    import FarmerCellList from "../../../components/crudl/farmer/FarmerCellList";
    import FarmerArticleConnect from "../../../components/crudl/farmer/FarmerArticleConnect";
    import FarmerArticleList from "../../../components/crudl/farmer/FarmerArticleList";

    export default {
        name: "overview",
        data() {
            return {
                update: false,
                cellId: null,
                reloadCompCel: 0,
                reloadCompArticle: 0,
            }
        },
        components: {
            FarmerArticleList,
            FarmerArticleConnect,
            FarmerCellList,
            FarmerCellCreate,
            FarmerCellUpdate
        },
        methods: {
            updateListener(id) {
                console.log('update: ' + id)
                this.cellId = id
                this.update = true
            },
            reloadListenerCel() {
                this.reloadCompCel += 1
            },
            reloadListenerArticle() {
                this.reloadCompArticle += 1
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
