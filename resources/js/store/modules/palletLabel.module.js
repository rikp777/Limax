import { PalletLabelService } from "../../common/api.service";

// action names
const FETCH_START = "setPalletLabelLoading";
const FETCH_END =  "resetPalletLabelLoading";

// mutation names
const SET_PALLETLABEL = "setPalletLabel";
const SET_PALLETLABELS = "setPalletLabels";



// Initial State
const state = {
    palletLabels: {},
    palletLabel: [],
    isLoading: true,
    palletLabelsCount: 0,
};

// Getters
const getters = {
    palletLabels(state) {
        return state.palletLabels;
    },
    palletLabel(state) {
        return state.palletLabel
    },
    palletLabelsCount(state) {
        return state.palletLabelsCount
    },
    palletLabelIsLoading(state) {
        return state.isLoading
    },

    palletLabelById: (state) => (id) => {
        let palletLabel = state.palletLabels.find(palletLabel => palletLabel.id === id);
        if(palletLabel) {
            return palletLabel;
        }
        this.getPalletLabel(id);

        return state.palletLabel;

    }
};

// Actions
const actions = {

    //get all articles
    async getAllPalletLabels(context){
        context.commit(FETCH_START);
        return PalletLabelService.getAll()
            .then(({ data }) => {
                context.commit(SET_PALLETLABELS, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single article
    async getPalletLabel(context, palletLabelSlug){
        if(state.article.id === palletLabelSlug){
            return;
        }

        context.commit(FETCH_START);
        return PalletLabelService.get(palletLabelSlug)
            .then(({ data }) => {
                //console.log(data);
                context.commit(SET_PALLETLABEL, data.data);
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
    [SET_PALLETLABELS](state, palletLabels){
        //console.log(palletLabels);
        state.palletLabels = palletLabels;
        state.palletLabelsCount = palletLabels.length;
    },
    [SET_PALLETLABEL](state, article){
        state.palletLabel = article;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}


