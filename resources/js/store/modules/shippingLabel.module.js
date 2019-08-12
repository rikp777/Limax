import { ShippingLabelService } from "../../common/api.service";

// action names
const FETCH_START = "setShippingLabelLoading";
const FETCH_END =  "resetShippingLabelLoading";

// mutation names
const SET_SHIPPINGLABEL = "setShippingLabel";
const SET_SHIPPINGLABELS = "setShippingLabels";



// Initial State
const state = {
    shippingLabels: {},
    shippingLabel: [],
    isLoading: true,
    shippingLabelsCount: 0,
};

// Getters
const getters = {
    shippingLabels(state) {
        return state.shippingLabels;
    },
    shippingLabel(state) {
        return state.shippingLabel
    },
    shippingLabelsCount(state) {
        return state.shippingLabelsCount
    },
    shippingLabelIsLoading(state) {
        return state.isLoading
    },

    shippingLabelById: (state) => (id) => {
        let shippingLabel = state.shippingLabels.find(shippingLabel => shippingLabel.id === id);
        if(shippingLabel) {
            return shippingLabel;
        }
        this.getShippingLabel(id);

        return state.shippingLabel;

    }
};

// Actions
const actions = {

    //get all shippinglabels
    async getAllShippingLabels(context){
        context.commit(FETCH_START);
        return ShippingLabelService.getAll()
            .then(({ data }) => {
                context.commit(SET_SHIPPINGLABELS, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single shippinglabel
    async getShippingLabel(context, shippingLabelSlug){
        if(state.shippingLabel.id === shippingLabelSlug){
            return;
        }

        context.commit(FETCH_START);
        return ShippingLabelService.get(shippingLabelSlug)
            .then(({ data }) => {
                //console.log(data);
                context.commit(SET_SHIPPINGLABEL, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },
};

// Mutations
export const mutations = {
    [FETCH_START](state) {
        state.isLoading = true;
    },
    [FETCH_END](state) {
        state.isLoading = false;
    },
    [SET_SHIPPINGLABELS](state, shippingLabels){
        //console.log(palletLabels);
        state.shippingLabels = shippingLabels;
        state.shippingLabelsCount = shippingLabels.length;
    },
    [SET_SHIPPINGLABEL](state, shippinglabel){
        state.shippingLabel = shippinglabel;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}


