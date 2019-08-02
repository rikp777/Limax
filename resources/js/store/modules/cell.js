import {CellService, PalletTypeService} from "../../common/api.service";

// action names
const FETCH_START = "setCellLoading";
const FETCH_END = "resetCellLoading";


// mutation names
const SET_PALLETTYPE = "setPalletType";
const SET_PALLETTYPES = "setAllPalletTypes";

// Initial State
const state = {
    cells: {},
    cell: [],
    calculation: [],
    isLoading: true,
    cellsCount: 0,
};

// Getters
const getters = {
    cells(state){
        return state.cells;
    },
    cell(state){
        return state.cell;
    },
    cellsCount(state) {
        return state.cellsCount
    },
    cellIsLoading(state) {
        return state.isLoading
    },


    cellById: (state) => (id) => {
        return state.cells.find(cell => cell.id === id)
    },
    cellByName: (state) => (name) => {
        return state.cells.find(cell => cell.name === name)
    },

};

// Actions
const actions = {
    //get all palletTypes
    async getAllCells(context){
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
    async getCell(context, palletTypeSlug, prevPalletType){
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
    UpdateAll(state, payload){
        state.all = payload
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
