<template>
    <b-card>
      <template>
  <div v-if="ShippingLabelPalletLabels">
<!--        {{ShippingLabelPalletLabels}}-->

      <template>
          <div class="card-body" v-on:click="checkPrint" id="printMe">
              <div style="
                  background: url('https://www.limax.nl/build/images/color-block.ac4809e9.svg') right bottom fixed;
                  background-size: cover;
                  display: block;
                  height: 100%;
                  width: 100%;
                  position: absolute;
                  top: 0;
                  left: 0;
                  z-index: 1;
                  filter: grayscale(99%);
                  opacity: 0.1;
              "></div>
              <div style="
                  display: block;
                  height: 100%;
                  width: 100%;
                  position: relative;
                  left: 0px;
                  top: 0px;
                  z-index: 2;
              ">
                  <div class="label1" style="page-break-after: always;">
                      <div class="text-center" style="z-index: 10;">
                          <!--                    <img class="card-img-top" style="width: 400px; height: auto; -webkit-filter: grayscale(100%); filter: grayscale(100%);" src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">-->
                          <img class="card-img-top" style="width: 400px; height: auto; margin-bottom: 10px"
                               src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">
                      </div>
                      <br>
                      <!--                STATUS-->
                      <div class="row">
                          <div class="col-sm-6" style="font-size: 16px;">
                              <strong>shippinglabel: </strong>{{uniqueshippingid}} | <strong>printed: </strong>{{$moment().format('dddd, MMMM Do YYYY') + ' ' + $moment().locale('nl').format('LTS')}}
                          </div>
                          <div class="col-sm-6" style="font-size: 16px;">
                              <span class="float-right"> <strong>Status: </strong>Ready </span>
                          </div>
                      </div>
                      <hr>
                      <!--                FROM / TO-->
                      <div class="row">
                          <template>
                              <div class="col-sm-2" style="font-size: 16px;">
                                  <h6 class="mb-3" style="font-size: 22px;">Transport :</h6>
                                  <div>Time: {{ $moment().locale('nl').format('LTS') }}</div>
                                  <div>Date: {{ $moment().locale('nl').format('L') }}</div>
                              </div>
                          </template>
                          <template>
                              <div class="col-sm-10" style="font-size: 16px;">
<!--                                  <h6 class="mb-3" style="font-size: 22px;">Transport :</h6>-->
<!--                                  &lt;!&ndash;                                <strong>Transport</strong>&ndash;&gt;-->
<!--                                  <div>Time: {{ $moment().locale('nl').format('LTS') }}</div>-->
<!--                                  <div>Date: {{ $moment().locale('nl').format('L') }}</div>-->
                                  <div class="row">
                                      <div class="col-3">
                                          <h6 class="mb-3" style="font-size: 16px;">Bruto KG Industrie :</h6>
                                          <div style="border-style: groove; width: 180px; height: 54px"></div>
                                      </div>
                                      <div class="col-3">
                                          <h6 class="mb-3" style="font-size: 16px;">Netto KG Industrie :</h6>
                                          <div style="border-style: groove; width: 180px; height: 54px"></div>
                                      </div>
                                      <div class="col-3">
                                          <h6 class="mb-3" style="font-size: 16px;">Driver name :</h6>
                                          <div style="border-style: groove; width: 180px; height: 54px"></div>
                                      </div>
                                      <div class="col-3">
                                          <h6 class="mb-3" style="font-size: 16px;">Driver signature :</h6>
                                          <div style="border-style: groove; width: 180px; height: 54px"></div>
                                      </div>
                                  </div>
                              </div>
                          </template>
                      </div>
                      <hr>

                      <div class="row">
                          <template>
                              <div class="col-sm-6" style="font-size: 18px;">
                                  <h6 class="mb-3" style="font-size: 22px;">FROM :</h6>
                                  <div>
                                      <strong>{{ farmer.name }}</strong>
                                      <div>{{ farmer.street }}, {{ farmer.houseNumber }}</div>
                                      <div>{{ farmer.place }}, {{ farmer.zipCode }}</div>
                                      <div>Email: {{ farmer.email }}</div>
                                      <div>Phone: {{ farmer.phone }}</div>
                                      <br>
                                      <strong>Certificates</strong>
                                      <div v-for="certificate in farmer.certificates">
                                          {{certificate.certificate.name}}: {{certificate.code}}
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template>
                              <div class="col-sm-6" style="font-size: 18px;">
                                  <h6 class="mb-3" style="font-size: 22px;">TO :</h6>
                                  <strong>Limax Horst</strong>
                                  <div>Venrayseweg, 126b</div>
                                  <div>Horst, 5961 AJ</div>
                                  <div>Email: info@limax.nl</div>
                                  <div>Phone: 773999660</div>
                                  <br>
                                  <strong>Limax Signature</strong>
                                  <div style="border-style: groove; width: 250px; height: 54px"></div>
                              </div>
                          </template>
                          <!--                        <template>-->
                          <!--                            <div class="col-sm-6" style="font-size: 22px;">-->
                          <!--                                <h6 class="mb-3" style="font-size: 26px;">Truck Driver :</h6>-->
                          <!--                                    <strong>{{truckDriver.trucker.firstName + " " + truckDriver.trucker.lastName}}</strong>-->
                          <!--                                    <div>License: {{truckDriver.licensePlate}}</div>-->
                          <!--                            </div>-->
                          <!--                        </template>-->
                      </div>
                      <hr>

                      <template>
<!--                            <div class="row mt-4">-->
<!--                                <div class="col-sm-6">-->
<!--                                    <h6 class="mb-3" style="font-size: 26px;">Total Pallets</h6>-->
<!--                                </div>-->

<!--                                <div class="col-sm-6">-->
<!--                                    <h6 class="mb-3" style="font-size: 26px;">Total </h6>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="row">-->
<!--                                <div class="col-sm-6" style="font-size: 22px;">-->
<!--                                    <table style="width: 100%">-->
<!--                                        <thead>-->
<!--                                        <tr>-->
<!--                                            <th>-->
<!--                                                Article:-->
<!--                                            </th>-->
<!--                                            <th>-->
<!--                                                Amount:-->
<!--                                            </th>-->
<!--                                        </tr>-->
<!--                                        </thead>-->
<!--                                        <tbody>-->
<!--                                        <tr v-for="total in ShippingLabelPalletLabels['total']" v-if="articles.length">-->
<!--                                            <td>-->
<!--                                                {{ getArticlesById(total.articleId).name }}-->
<!--                                            </td>-->
<!--                                            <td>-->
<!--                                                {{ total.amount }}-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                                </div>-->
<!--                                <div class="col-sm-6" style="font-size: 22px;">-->
<!--                                    <table style="width: 100%">-->
<!--                                        <thead>-->
<!--                                        <tr>-->
<!--                                            <th>-->
<!--                                                Nr.:-->
<!--                                            </th>-->
<!--                                            <th>-->
<!--                                                Article:-->
<!--                                            </th>-->
<!--                                            <th>-->
<!--                                                Amount:-->
<!--                                            </th>-->
<!--                                        </tr>-->
<!--                                        </thead>-->
<!--                                        <tbody>-->
<!--                                        <tr v-for="detail in ShippingLabelPalletLabels['detail']"-->
<!--                                            v-if="articles.length">-->
<!--                                            <td>-->
<!--                                                {{ detail.palletlabelId }}-->
<!--                                            </td>-->
<!--                                            <td>-->
<!--                                                {{ getArticlesById(detail.articleId).name }}-->
<!--                                            </td>-->
<!--                                            <td>-->
<!--                                                {{ detail.amount }}-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <hr>-->
                          <div class="row mt-4">
                              <div class="col-sm-6">
                                  <h6 class="mb-3" style="font-size: 22px;">Total</h6>
                              </div>

                              <div class="col-sm-6">
                                  <h6 class="mb-3" style="font-size: 22px;">Detail</h6>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-sm-6" style="font-size: 20px;">
                                  <table style="width: 100%">
                                      <thead>
                                      <tr>
                                          <th>
                                              Article:
                                          </th>
                                          <th>
                                              Amount:
                                          </th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr v-for="total in ShippingLabelPalletLabels['total']" v-if="articles.length">
                                          <td>
<!--                                              {{ getArticlesById(Number(total.articleId)).name }}-->
                                              {{ total.article }}
                                          </td>
                                          <td>
                                              {{ total.amount }}
                                          </td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                              <div class="col-sm-6" style="font-size: 20px;">
                                  <table style="width: 100%">
                                      <thead>
                                      <tr>
                                          <th>
                                              Nr Limax.:
                                          </th>
                                          <th>
                                              Nr.:
                                          </th>
                                          <th>
                                              Article:
                                          </th>
                                          <th>
                                              Amount:
                                          </th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr v-for="detail in ShippingLabelPalletLabels['detail']"
                                          v-if="articles.length">
                                          <td>
                                              {{ detail.palletlabelId }}
                                          </td>
                                          <td>
                                              {{ detail.palletlabelfarmerId }}
                                          </td>
                                          <td>
                                              {{ getArticlesById(Number(detail.articleId)).name }}
                                          </td>
                                          <td>
                                              {{ detail.amount }}
                                          </td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>

                          <hr>
                          <div class="row mt-4">
                              <div class="col-sm-6" style="font-size: 22px;">
                                  <h6 class="mb-3" style="font-size: 22px;">Total Pallets</h6>
                              </div>

                              <div class="col-sm-6" style="font-size: 22px;">
                                  <h6 class="mb-3" style="font-size: 22px;">Pallet Types</h6>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-6" style="font-size: 18px;">
                                  <table style="width: 100%">
                                      <thead>
                                      <tr>
                                          <th>
                                              Count:
                                          </th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr>
                                          <td>
                                              {{ShippingLabelPalletLabels['palletlabelCount']}}
                                          </td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                              <div class="col-sm-6" style="font-size: 18px;">
<!--                                    {{ShippingLabelPalletLabels['palletTypes']}}-->
<!--                                    <div v-for="(value, name) in ShippingLabelPalletLabels['palletTypes']">-->
<!--                                        {{name}} : {{value}}-->
<!--                                    </div>-->
                                  <table style="width: 100%">
                                      <thead>
                                      <tr>
                                          <th>
                                              Type:
                                          </th>
                                          <th>
                                              Count:
                                          </th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr v-for="(value, name) in ShippingLabelPalletLabels['palletTypes']"
                                          v-if="articles.length">
                                          <td>
                                              {{name}}
                                          </td>
                                          <td>
                                              {{value}}
                                          </td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <hr>
                          <br>
                          <br>
                          <div class="row">
                              <div class="barcodee" style="font-family: 'Libre Barcode 39', cursive;">
                              </div>
                          </div>
                          <div class="row">
                              <div class="text-center">
                                  <!--                            <img class="card-img-bottom" style=" bottom:0; -webkit-filter: grayscale(100%); filter: grayscale(100%);" src='https://www.limax.nl/build/images/color-bar.48031fde.svg' alt="Card image cap">-->
<!--                                  <img class="card-img-bottom" style=" bottom:0;"-->
<!--                                       src='https://www.limax.nl/build/images/color-bar.48031fde.svg'-->
<!--                                       alt="Card image cap">-->
                              </div>
                          </div>
                      </template>
                  </div>
                  <div class="label2" style="page-break-after: always;">
                      <div class="text-center" style="z-index: 10;">
                          <!--                    <img class="card-img-top" style="width: 400px; height: auto; -webkit-filter: grayscale(100%); filter: grayscale(100%);" src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">-->
                          <img class="card-img-top" style="width: 400px; height: auto; margin-bottom: 10px"
                               src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">
                      </div>
                      <br>
                      <!--                STATUS-->
                      <div class="row">
                          <div class="col-sm-6" style="font-size: 16px;">
                              <strong>shippinglabel: </strong>{{uniqueshippingid}} | <strong>printed: </strong>{{$moment().format('dddd, MMMM Do YYYY') + ' ' + $moment().locale('nl').format('LTS')}}
                          </div>
                          <div class="col-sm-6" style="font-size: 16px;">
                              <span class="float-right"> <strong>Status: </strong>Ready </span>
                          </div>
                      </div>
                      <hr>
                      <!--                FROM / TO-->
                      <div class="row">
                          <template>
                              <div class="col-sm-2" style="font-size: 16px;">
                                  <h6 class="mb-3" style="font-size: 22px;">Transport :</h6>
                                  <div>Time: {{ $moment().locale('nl').format('LTS') }}</div>
                                  <div>Date: {{ $moment().locale('nl').format('L') }}</div>
                              </div>
                          </template>
                          <template>
                              <div class="col-sm-10" style="font-size: 16px;">
                                  <!--                                  <h6 class="mb-3" style="font-size: 22px;">Transport :</h6>-->
                                  <!--                                  &lt;!&ndash;                                <strong>Transport</strong>&ndash;&gt;-->
                                  <!--                                  <div>Time: {{ $moment().locale('nl').format('LTS') }}</div>-->
                                  <!--                                  <div>Date: {{ $moment().locale('nl').format('L') }}</div>-->
                                  <div class="row">
                                      <div class="col-3">
                                          <h6 class="mb-3" style="font-size: 16px;">Bruto KG Industrie :</h6>
                                          <div style="border-style: groove; width: 180px; height: 54px"></div>
                                      </div>
                                      <div class="col-3">
                                          <h6 class="mb-3" style="font-size: 16px;">Netto KG Industrie :</h6>
                                          <div style="border-style: groove; width: 180px; height: 54px"></div>
                                      </div>
                                      <div class="col-3">
                                          <h6 class="mb-3" style="font-size: 16px;">Driver name :</h6>
                                          <div style="border-style: groove; width: 180px; height: 54px"></div>
                                      </div>
                                      <div class="col-3">
                                          <h6 class="mb-3" style="font-size: 16px;">Driver signature :</h6>
                                          <div style="border-style: groove; width: 180px; height: 54px"></div>
                                      </div>
                                  </div>
                              </div>
                          </template>
                      </div>
                      <hr>

                      <div class="row">
                          <template>
                              <div class="col-sm-6" style="font-size: 18px;">
                                  <h6 class="mb-3" style="font-size: 22px;">FROM :</h6>
                                  <div>
                                      <strong>{{ farmer.name }}</strong>
                                      <div>{{ farmer.street }}, {{ farmer.houseNumber }}</div>
                                      <div>{{ farmer.place }}, {{ farmer.zipCode }}</div>
                                      <div>Email: {{ farmer.email }}</div>
                                      <div>Phone: {{ farmer.phone }}</div>
                                      <br>
                                      <strong>Certificates</strong>
                                      <div v-for="certificate in farmer.certificates">
                                          {{certificate.certificate.name}}: {{certificate.code}}
                                      </div>
                                  </div>
                              </div>
                          </template>
                          <template>
                              <div class="col-sm-6" style="font-size: 18px;">
                                  <h6 class="mb-3" style="font-size: 22px;">TO :</h6>
                                  <strong>Limax Horst</strong>
                                  <div>Venrayseweg, 126b</div>
                                  <div>Horst, 5961 AJ</div>
                                  <div>Email: info@limax.nl</div>
                                  <div>Phone: 773999660</div>
                                  <br>
                                  <strong>Limax Signature</strong>
                                  <div style="border-style: groove; width: 250px; height: 54px"></div>
                              </div>
                          </template>
                          <!--                        <template>-->
                          <!--                            <div class="col-sm-6" style="font-size: 22px;">-->
                          <!--                                <h6 class="mb-3" style="font-size: 26px;">Truck Driver :</h6>-->
                          <!--                                    <strong>{{truckDriver.trucker.firstName + " " + truckDriver.trucker.lastName}}</strong>-->
                          <!--                                    <div>License: {{truckDriver.licensePlate}}</div>-->
                          <!--                            </div>-->
                          <!--                        </template>-->
                      </div>
                      <hr>

                      <template>


                          <div class="row mt-4">
                              <div class="col-sm-6">
                                  <h6 class="mb-3" style="font-size: 22px;">Total</h6>
                              </div>

                              <div class="col-sm-6">
                                  <h6 class="mb-3" style="font-size: 22px;">Detail</h6>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-sm-6" style="font-size: 20px;">
                                  <table style="width: 100%">
                                      <thead>
                                      <tr>
                                          <th>
                                              Article:
                                          </th>
                                          <th>
                                              Amount:
                                          </th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr v-for="total in ShippingLabelPalletLabels['total']" v-if="articles.length">
                                          <td>
                                              {{ getArticlesById(Number(total.articleId)).name }}
                                          </td>
                                          <td>
                                              {{ total.amount }}
                                          </td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                              <div class="col-sm-6" style="font-size: 20px;">
                                  <table style="width: 100%">
                                      <thead>
                                      <tr>
                                          <th>
                                              Nr Limax.:
                                          </th>
                                          <th>
                                              Nr.:
                                          </th>
                                          <th>
                                              Article:
                                          </th>
                                          <th>
                                              Amount:
                                          </th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr v-for="detail in ShippingLabelPalletLabels['detail']"
                                          v-if="articles.length">
                                          <td>
                                              {{ detail.palletlabelId }}
                                          </td>
                                          <td>
                                              {{ detail.palletlabelfarmerId }}
                                          </td>
                                          <td>
                                              {{ getArticlesById(Number(detail.articleId)).name }}
                                          </td>
                                          <td>
                                              {{ detail.amount }}
                                          </td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>

                          <hr>
                          <div class="row mt-4">
                              <div class="col-sm-6" style="font-size: 22px;">
                                  <h6 class="mb-3" style="font-size: 22px;">Total Pallets</h6>
                              </div>

                              <div class="col-sm-6" style="font-size: 22px;">
                                  <h6 class="mb-3" style="font-size: 22px;">Pallet Types</h6>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-6" style="font-size: 18px;">
                                  <table style="width: 100%">
                                      <thead>
                                      <tr>
                                          <th>
                                              Count:
                                          </th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr>
                                          <td>
                                              {{ShippingLabelPalletLabels['palletlabelCount']}}
                                          </td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                              <div class="col-sm-6" style="font-size: 18px;">
                                  <!--                                    {{ShippingLabelPalletLabels['palletTypes']}}-->
                                  <!--                                    <div v-for="(value, name) in ShippingLabelPalletLabels['palletTypes']">-->
                                  <!--                                        {{name}} : {{value}}-->
                                  <!--                                    </div>-->
                                  <table style="width: 100%">
                                      <thead>
                                      <tr>
                                          <th>
                                              Type:
                                          </th>
                                          <th>
                                              Count:
                                          </th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr v-for="(value, name) in ShippingLabelPalletLabels['palletTypes']"
                                          v-if="articles.length">
                                          <td>
                                              {{name}}
                                          </td>
                                          <td>
                                              {{value}}
                                          </td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <hr>
                          <br>
                          <br>
                          <div class="row">
                              <div class="barcodee" style="font-family: 'Libre Barcode 39', cursive;">
                              </div>
                          </div>
                          <div class="row">
                              <div class="text-center">
                                  <!--                            <img class="card-img-bottom" style=" bottom:0; -webkit-filter: grayscale(100%); filter: grayscale(100%);" src='https://www.limax.nl/build/images/color-bar.48031fde.svg' alt="Card image cap">-->
<!--                                  <img class="card-img-bottom" style=" bottom:0;"-->
<!--                                       src='https://www.limax.nl/build/images/color-bar.48031fde.svg'-->
<!--                                       alt="Card image cap">-->
                              </div>
                          </div>
                      </template>
                  </div>
              </div>

          </div>
          <div class="card-body" style="page-break-after: always;">
          </div>
      </template>
  </div>

</template>
    </b-card>

</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    // import palletLabel from "../../router/routes/palletLabel";
    // import {getToken} from '../../common/jwt.service';

    export default {
        name: 'shippingLabel-pdf',
        data() {
            return {
                uniqueshippingid: this.$route.params.id
            }
        },
        computed: {
            // ...mapGetters(["authUser"]),
            ...mapGetters({
                authFarmer: 'authFarmer',
                authUser: 'authUser',
                authUserFarmers: 'authUserFarmers',
            }),
            shippingLabelCount() {
                return this.$store.getters.shippingLabelsCount;
            },
            articles() {
                return this.$store.getters.articles
            },
            article() {
                return this.$store.getters.article;
            },
            palletLabel() {
                return this.$store.getters.palletLabel;
            },
            ShippingLabelPalletLabels() {
                return this.$store.getters.shippingLabel;
            },
            farmer() {
                return this.$store.getters.farmer;
            },
            truckDriver() {
                return this.$store.getters.truck;
            },
            isLoading() {
                return this.$store.getters.farmerIsLoading;
            }
        },
        methods: {
            getFarmer(id) {
                this.$store.dispatch("getFarmer", id);
            },
            getTruck(id) {
                this.$store.dispatch("getTruck", id);
            },
            getArticlesById(id) {
                return this.$store.getters.articleById(id);
            },
            getArticle(id) {
                this.$store.dispatch("getArticle", id);
            },
            getShippingLabelPalletLabels(id) {
                // console.log('getShippingLabelPalletLabels id = ' + id);
                this.$store.dispatch("getShippingLabel", id);
            },
            getFarmer(id) {
                this.$store.dispatch("getFarmer", id);
            },
            checkPrint() {
                this.$htmlToPaper('printMe');
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
        },
        mounted() {
            // console.log(this.$route.params.id),
            Promise.all([
                this.getFarmer(this.authFarmer.id),
                // console.log(this.$route.params.id),
                // this.getShippingLabelPalletLabels(this.$route.params.id),
                this.$store.dispatch("getShippingLabel", this.$route.params.id),
                this.getAllArticles(),
            ]).finally(() => {
                // console.log(" nu ben ik klaar");
                // this.checkPrint();
            })
        },
    }
</script>
<style scoped>
    .barcodee {
    @import url('https://fonts.googleapis.com/css?family=Libre+Barcode+39&display=swap');
        font-family: 'Libre Barcode 39', cursive;
        font-size: 100%;
    }
</style>
