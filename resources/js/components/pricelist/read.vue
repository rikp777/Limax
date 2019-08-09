<template>
    <div class="card" >
        <div class="card-header">
            <h5 class="card-title">Pricelist</h5>
        </div>
        <div class="card-body">
            <div class="text-center" >
                <img class="card-img-top" style="max-width: 50%" src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">
            </div>
            <div class="row">
                <div class="col-sm-6" style="font-size: 16px;">
                    <strong>Palletlabel: </strong>{{ moment().format("dddd, MMMM Do YYYY") }}
                </div>
                <div class="col-sm-6" style="font-size: 16px;">
                    <span class="float-right"> <strong>Status: </strong>Ready </span>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"> </th>
                                <th scope="col">Product</th>
                                <th scope="col">Origin</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="index in 5" :key="index">
                                <td style="width:  20%"><img class="img-fluid img-thumbnail rounded float-left" src="https://static.independent.co.uk/s3fs-public/thumbnails/image/2017/01/25/10/mushroom-istock-onebluelight.jpg?w968h681" /> </td>
                                <td>
                                    <h5><strong>Grey oyster leaved mushrooms(1,5kg)</strong></h5>
                                    <ul>
                                        <li>blabla</li>
                                        <li>blabla</li>
                                        <li>blabla</li>
                                    </ul>
                                </td>
                                <td>Hungary</td>
                                <td scope="col" class="text-center">16640</td>
                                <td scope="col" class="text-center">124,90 €</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "read.vue"
    }
</script>

<style scoped>

</style>
