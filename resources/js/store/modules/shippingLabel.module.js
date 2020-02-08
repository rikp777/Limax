import {PalletLabelService, ShippingLabelService} from "../../common/api.service";
import shippingLabel from "../../router/routes/shippingLabel";

// action names
const FETCH_START = "setShippingLabelLoading";
const FETCH_END = "resetShippingLabelLoading";

// mutation names
const SET_SHIPPINGLABEL = "setShippingLabel";
const SET_SHIPPINGLABELS = "setShippingLabels";
// const SET_LABELSPAGINATED = "setShippingLabelsPaginated";


// Initial State
const state = {
    shippingLabels: {},
    // shippingLabelsPaginated: {},
    shippingLabel: [],
    isLoading: true,
    shippingLabelsCount: 0,
};

// Getters
const getters = {
    shippingLabels(state) {
        // console.log(state);
        return state.shippingLabels;
    },
    shippingLabel(state) {
        // console.log(state.shippingLabel);
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
        if (shippingLabel) {
            return shippingLabel;
        }
        this.getShippingLabel(id);

        return state.shippingLabel;

    }
};

// Actions
const actions = {
    //get all shippinglabels
    async getAllShippingLabels(context) {
        context.commit(FETCH_START);
        return ShippingLabelService.getAll()
            .then(({data}) => {
                // console.log(data);
                context.commit(SET_SHIPPINGLABELS, data);
                // context.commit(SET_LABELSPAGINATED, data.paginated.data);
                context.commit(FETCH_END);
                // console.log(SET_SHIPPINGLABELS);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single shippinglabel
    async getShippingLabel(context, shippingLabelSlug) {
        // if (state.shippingLabel.id === shippingLabelSlug) {
        //     return;
        // }
        context.commit(FETCH_START);
        return ShippingLabelService.get(shippingLabelSlug)
            .then(({ data }) => {
                // console.log(data);
                context.commit(SET_SHIPPINGLABEL, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },

//create palletLabel
    async createShippingLabel(context, payload) {
        // console.log(payload);
        // const data = payload;
        const {data} = await ShippingLabelService.create(payload);
        context.commit(SET_SHIPPINGLABEL, data);
        // console.log(data);
        return data;
    },

    //update palletLabel
    async updateShippingLabel(context, payload) {
        // console.log(payload);
        const {data} = await ShippingLabelService.update(payload.id, payload);
        context.commit(SET_SHIPPINGLABEL, data);
        return data;
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
    [SET_SHIPPINGLABELS](state, shippingLabels) {
        // console.log(shippingLabels);
        state.shippingLabels = shippingLabels;
        // console.log(state.shippingLabels);
        state.shippingLabelsCount = shippingLabels.length;
    },
    // [SET_LABELSPAGINATED](state, shippingLabelsPaginated){
    //     //console.log(palletLabelsPaginated);
    //     state.shippingLabelsPaginated = shippingLabelsPaginated;
    // },
    [SET_SHIPPINGLABEL](state, shippingLabel) {
        state.shippingLabel = shippingLabel;
        // state.shippingLabelsCount = shippingLabel.length +1;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
