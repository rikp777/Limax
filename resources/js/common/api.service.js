import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios"

import JwtService from "./jwt.service";
import { API_URL } from "./config";

const ApiService  = {
    initialize() {
        Vue.use(VueAxios, axios);
        Vue.axios.defaults.baseURL = API_URL;
    },

    setHeader() {
        Vue.axios.defaults.headers.common["Authorization"] = `Bearer ${JwtService.getToken()}`
    },

    query(resource, params) {
        return Vue.axios
            .get(`${resource}`, params)
            .catch(error => {
                throw `[Limax] ApiService ${resource} \n ${error.response.data.message}`;
            });
    },

    get(resource, slug = "") {
        // throw(`${resource}/${slug}`);
        return Vue.axios
            .get(`${resource}/${slug}`)
            .catch(error => {
                throw `[Limax] ApiService ${resource} \n ${error.response.data.message}`;
            });
    },

    post(resource, params) {
        return Vue.axios
            .post(`${resource}`, params)
            .catch(error => {
                throw `[Limax] ApiService ${resource} \n ${error.response.data.message}`;
            });
    },

    update(resource, slug, params) {
        return Vue.axios
            .put(`${resource}/${slug}`, params)
            .catch(error => {
                throw `[Limax] ApiService ${resource}/${slug} \n ${error.response.data.message}`;
            });
    },

    put(resource, params) {
        return Vue.axios
            .put(`${resource}`, params)
            .catch(error => {
                throw `[Limax] ApiService ${resource} \n ${error.response.data.message}`;
            });
    },

    delete(resource, slug) {
        return Vue.axios
            .delete(`${resource}/${slug}`)
            .catch(error => {
                throw `[Limax] ApiService ${resource}/${slug} \n ${error.response.data.message}`;
            });
    }
};

export default ApiService;



const ArticleApi = "article";
export const ArticlesService  = {
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
