import { CellService } from "../../common/api.service";

// action names
const FETCH_START = "setCellLoading";
const FETCH_END = "resetCellLoading";


// mutation names
const SET_CELL = "setCell";
const SET_CELLS = "setAllCells";

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

    calculation(state){
        return state.calculation
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
    //get all cells
    async getAllCells(context){
        context.commit(FETCH_START);
        return CellService.getAll()
            .then(({ data }) => {
                context.commit(SET_CELLS, data.data);
            })
            .catch(error => {
                throw new Error(error)
            })
    },

    //get single cell
    async getCell(context, cellSlug) {
        if (state.cells.id === cellSlug) {
            return;
        }

        context.commit(FETCH_START);
        return CellService.get(cellSlug)
            .then(({data}) => {
                context.commit(SET_CELL, data.data);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    },

    //get single cell
    async getCultivationCalculationCell(context, cellSlug) {
        context.commit(FETCH_START);
        return CellService.getCultivationCalculationCell(cellSlug)
            .then(({data}) => {
                context.commit('setCalculation', data.data.calculation);
                context.commit(FETCH_END);
            })
            .catch(error => {
                throw error
            });
    }
};

// Mutations
const mutations = {
    [FETCH_START](state) {
        state.isLoading = true;
    },
    [FETCH_END](state) {
        state.isLoading = false;
    },
    [SET_CELLS](state, cells){
        state.cells = cells;
        state.cellsCount = cells.length;
    },
    [SET_CELL](state, cell){
        state.cell = cell;
    },
    setCalculation(state, calculation){
        console.log(calculation);
        state.calculation = calculation
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
