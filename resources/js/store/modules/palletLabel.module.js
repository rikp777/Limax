import {ArticleService, PalletLabelService, PalletLabelStatusService, UserService} from "../../common/api.service";
import palletLabel from "../../router/routes/palletLabel";


// action names
const FETCH_START = "setPalletLabelLoading";
const FETCH_END =  "resetPalletLabelLoading";

// mutation names
const SET_PALLETLABEL = "setPalletLabel";
const SET_PALLETLABELS = "setPalletLabels";
const SET_LABELSPAGINATED = "setPalletLabelsPaginated";


// Initial State
const state = {
    palletLabels: {},
    palletLabelsPaginated: {},
    palletLabel: [],
    isLoading: true,
    palletLabelsCount: 0,
};

// Getters
const getters = {
    palletLabels(state) {
        return state.palletLabels;
    },
    palletLabelsPaginated(state) {
        return state.palletLabelsPaginated;
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
    //get all palletLabels
    async getAllPalletLabels(context){
        context.commit(FETCH_START);
        return PalletLabelService.getAll()
            .then(({ data }) => {
                // console.log(data.all);
                // console.log(data.paginated.data);
                context.commit(SET_PALLETLABELS, data.data);
                // context.commit(SET_PALLETLABELS, data.all);
                // context.commit(SET_LABELSPAGINATED, data.paginated.data);
                context.commit(FETCH_END);
                // console.log(state.palletLabels);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single palletLabels
    async getPalletLabel(context, palletLabelSlug){
        if(state.palletLabel.id === palletLabelSlug){
            return;
        }

        context.commit(FETCH_START);
        return PalletLabelService.get(palletLabelSlug)
            .then(({ data }) => {
                console.log(data);
                context.commit(SET_PALLETLABEL, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },

    //create palletLabel
     createPalletLabel(context, payload) {
        return PalletLabelService.create(payload)
            .then(({data}) => {
                // console.log(data.data);
                context.commit(SET_PALLETLABEL, data.data);
            }).catch( (error) => {
                 throw error
         })
    },

    //create palletLabel
    // async createPalletLabel(context, payload) {
    //     // console.log(payload);
    //     // const data = payload;
    //     const { data } = await PalletLabelService.create(payload);
    //     context.commit(SET_PALLETLABEL, data);
    //     console.log(data);
    //     return data;
    // },

    //update palletLabel
    // async updatePalletLabel(context, payload) {
    //     console.log('updatePalletLabel');
    //     const { data } = await PalletLabelService.update(payload.id, payload);
    //     context.commit(SET_PALLETLABEL, data);
    //     return data;
    // },

    updatePalletLabel(context, payload) {
        return PalletLabelService.update(payload.id, payload)
            .then(({data}) => {
                // console.log(data.data);
                context.commit(SET_PALLETLABEL, data.data);
            }).catch( (error) => {
                throw error
            })
    },

    //update palletLabelStatus
    async updatePalletLabelStatus(context, payload) {
        // console.log(payload);
        payload.forEach(function(palletLabelID) {
            // console.log(palletLabelID);
            const { data } = PalletLabelStatusService.update(palletLabelID.id);
            context.commit(SET_PALLETLABEL, data);
            return data;
        });


        // const { data } = await PalletLabelService.update(payload);
        // context.commit(SET_PALLETLABEL, data);
        // return data;
    },
    //create palletLabelStatus
    async createShippingPalletID(context, payload) {
        // console.log(payload);
        // payload.selectedLabels.forEach(function(palletLabelID) {
            // console.log(palletLabelID);
            const {data} = PalletLabelStatusService.create(payload);
            context.commit(SET_PALLETLABEL, data);
            return data;
        // });
    },

    //delete palletlabel
    deletePalletLabel(context, palletLabelSlug) {
        return PalletLabelService.delete(palletLabelSlug)
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
    [SET_LABELSPAGINATED](state, palletLabelsPaginated){
        //console.log(palletLabelsPaginated);
        state.palletLabelsPaginated = palletLabelsPaginated;
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
