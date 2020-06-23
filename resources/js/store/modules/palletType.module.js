import {PalletTypeService} from "../../common/api.service";

// action names
const FETCH_START = "setPalletLabelLoading";
const FETCH_END =  "resetPalletLabelLoading";

// mutation names
const SET_PALLETTYPE = "setPalletType";
const SET_PALLETTYPES = "setAllPalletTypes";




// Initial State
const state = {
    palletTypes: {},
    palletType: [],
    isLoading: true,
    palletTypesCount: 0,
};

// Getters
const getters = {
    palletTypes(state) {
        return state.palletTypes;
    },
    palletType(state) {
        return state.palletType;
    },
    palletTypesCount(state) {
        return state.palletTypesCount;
    },
    isLoading(state) {
        return state.isLoading;
    },


    palletTypeById: (state) => (id) => {
        return state.palletTypes.find(palletType => palletType.id === id)
    },
    palletTypeByName: (state) => (name) => {
        return state.palletTypes.find(palletType => palletType.name === name)
    },
};

// Actions
const actions = {

    //get all palletTypes
    async getAllPalletTypes(context){
        context.commit(FETCH_START);
        return PalletTypeService.getAll()
            .then(({ data }) => {
                context.commit(SET_PALLETTYPES, data.data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single article
    async getPalletType(context, palletTypeSlug, prevPalletType){
        context.commit(FETCH_START);
        if(prevPalletType !== undefined){
            return context.commit(SET_PALLETTYPE, prevPalletType);
        }
        const { data } = await PalletTypeService.get(palletTypeSlug);
        context.commit(SET_PALLETTYPE, data);
        return data;
    },
};

// Mutations
const mutations = {
    [FETCH_START](state){
        state.isLoading = true;
    },
    [SET_PALLETTYPES](state, palletTypes) {
        state.palletTypes = palletTypes;
        state.palletTypesCount = palletTypes.length;
        state.isLoading = false;
    },
    [SET_PALLETTYPE](state, palletType){
        state.palletType = palletType;
        state.isLoading = false;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
