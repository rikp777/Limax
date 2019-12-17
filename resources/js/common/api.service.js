import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios"

import JwtService from "./jwt.service";
import { API_URL } from "./config";
import applyConverters  from "axios-case-converter";


const ApiService  = {
    initialize() {
        Vue.use(VueAxios, axios);
        Vue.axios.defaults.baseURL = API_URL;
    },

    setHeader() {
        Vue.axios.defaults.headers.common["Authorization"] = `Bearer ${JwtService.getToken('user')}`;
        Vue.axios.defaults.headers.common["farmerId"] = `${JwtService.getToken('farmer')}`;
    },

    query(resource, params) {
        const request = applyConverters(Vue.axios)
            .get(`${resource}`, params)
            .catch(error => {
                throw `[Limax] ApiService ${resource} \n ${error.response.data.message}`;
            });
        return request;
    },

   get(resource, slug = "") {
        // console.log('resource = ' + resource);
        // console.log('slug = ' + slug);
        const request = applyConverters(Vue.axios)
            .get(`${resource}/${slug}`)
            .catch(error => {
                throw `[Limax] ApiService ${resource} \n ${error.response.data.message}`;
            });
        // console.log('request = ' + request);
        return request;
    },

    post(resource, params) {
        const request = applyConverters(Vue.axios)
            .post(`${resource}`, params)
            .catch(error => {
                throw `[Limax] ApiService ${resource} \n ${error.response.data.message}`;
            });
        return request;
    },

    update(resource, slug, params) {
        const request = applyConverters(Vue.axios)
            .put(`${resource}/${slug}`, params)
            .catch(error => {
                throw `[Limax] ApiService ${resource}/${slug} \n ${error.response.data.message}`;
            });
        return request;
    },

    put(resource, params) {
        const request = applyConverters(Vue.axios)
            .put(`${resource}`, params)
            .catch(error => {
                throw `[Limax] ApiService ${resource} \n ${error.response.data.message}`;
            });
        return request
    },

    delete(resource, slug) {
        const request = applyConverters(Vue.axios)
            .delete(`${resource}/${slug}`)
            .catch(error => {
                throw `[Limax] ApiService ${resource}/${slug} \n ${error.response.data.message}`;
            });
        return request
    }
};

export default ApiService;



const ArticleApi = "article";
export const ArticleService  = {
    create(params){
        return ApiService.post(ArticleApi, { article: params})
    },
    update(slug, params) {
        return ApiService.update(ArticleApi, slug, { article: params });
    },
    delete(slug) {
        return ApiService.delete(ArticleApi, slug);
    },
    get(slug){
        return ApiService.get(ArticleApi, slug)
    },
    getAll() {
        return ApiService.get(ArticleApi)
    }
};

// Truck Module
const TruckApi = "truck";
export const TruckService  = {
    create(params){
        return ApiService.post(TruckApi, { truck: params})
    },
    update(slug, params) {
        return ApiService.update(TruckApi, slug, { truck: params });
    },
    delete(slug) {
        return ApiService.delete(TruckApi, slug);
    },
    get(slug){
        console.log("get(slug) - TruckApi");
        return ApiService.get(TruckApi, slug)
    },
    getAll() {
        console.log("getAll(slug) - TruckApi");
        return ApiService.get(TruckApi)
    }
};


const PalletTypeApi = "pallettype";
export const PalletTypeService = {
    create(params){
        return ApiService.post(PalletTypeApi, { palletType: params})
    },
    update(slug, params) {
        return ApiService.update(PalletTypeApi, slug, { palletType: params });
    },
    delete(slug) {
        return ApiService.delete(PalletTypeApi, slug);
    },
    get(slug){
        return ApiService.get(PalletTypeApi, slug)
    },
    getAll() {
        return ApiService.get(PalletTypeApi)
    }
};


//PalletLabel
const PalletLabelApi = "palletlabel";
export const PalletLabelService = {
    create(params){
        return ApiService.post(PalletLabelApi, params)
    },
    update(slug, params) {
        return ApiService.update(PalletLabelApi, slug, params);
    },
    delete(slug) {
        return ApiService.delete(PalletLabelApi, slug);
    },
    get(slug){
        return ApiService.get(PalletLabelApi, slug)
    },
    getAll() {
        return ApiService.get(PalletLabelApi)
    }
};

//PalletLabelStatus
const PalletLabelStatusApi = "palletlabelStatus";
export const PalletLabelStatusService = {
    create(params) {
        return ApiService.post(PalletLabelStatusApi, { ShippingPalletLabel: params});
    },
    update(slug, params) {
        return ApiService.update(PalletLabelStatusApi, slug, params);
    }
};



//Shippinglabel
const ShippingLabelApi = "shippinglabel";
export const ShippingLabelService = {
    create(params){
        return ApiService.post(ShippingLabelApi, { shippingLabel: params})
    },
    update(slug, params) {
        return ApiService.update(ShippingLabelApi, slug, { shippingLabel: params });
    },
    delete(slug) {
        return ApiService.delete(ShippingLabelApi, slug);
    },
    get(slug){
        // console.log('api = ' + ShippingLabelApi);
        // console.log('slug = ' + slug);
        return ApiService.get(ShippingLabelApi, slug)
    },
    getAll() {
        return ApiService.get(ShippingLabelApi)
    }
};


//Cell
const CellApi = "cell";
export const CellService = {
    create(params){
        return ApiService.post(CellApi, { cell: params})
    },
    update(slug, params) {
        return ApiService.update(CellApi, slug, { cell: params });
    },
    delete(slug) {
        return ApiService.delete(CellApi, slug);
    },
    get(slug){
        return ApiService.get(CellApi, slug)
    },
    getAll() {
        return ApiService.get(CellApi)
    },
    getCultivationCalculationCell(slug){
        return ApiService.get('/cultivationcycle/calculate', slug)
    }
};


//Farmer
const FarmerApi = "farmer";
export const FarmerService = {
    create(params){
        return ApiService.post(FarmerApi, { farmer: params})
    },
    update(slug, params) {
        return ApiService.update(FarmerApi, slug, { farmer: params });
    },
    delete(slug) {
        return ApiService.delete(FarmerApi, slug);
    },
    get(slug){
        return ApiService.get(FarmerApi, slug)
    },
    getAll() {
        return ApiService.get(FarmerApi)
    },
};
