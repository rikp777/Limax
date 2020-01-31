// import {ArticleService, ArticleFarmerService, PalletLabelService, UserService} from "../../common/api.service";
//
// // action names
// const FETCH_START = "setArticleFarmerLoading";
// const FETCH_END = "resetArticleFarmerLoading";
//
//
// // mutation names
// const SET_ARTICLEFARMER = "setArticleFarmer";
// const SET_ARTICLEFARMERS = "setAllArticleFarmers";
//
// // Initial State
// const state = {
//     articlefarmers: {},
//     articlefarmer: [],
//     calculation: [],
//     isLoading: true,
//     articlefarmersCount: 0,
// };
//
// // Getters
// const getters = {
//     articlefarmers(state){
//         return state.articlefarmers;
//     },
//     articlefarmer(state){
//         return state.articlefarmer;
//     },
//     articlefarmersCount(state) {
//         return state.articlefarmersCount
//     },
//     articlefarmerIsLoading(state) {
//         return state.isLoading
//     },
//
//     calculation(state){
//         return state.calculation
//     },
//
//
//     articlefarmerById: (state) => (id) => {
//         return state.articlefarmers.find(articlefarmer => articlefarmer.id === id)
//     },
//     articlefarmerByName: (state) => (name) => {
//         return state.articlefarmers.find(articlefarmer => articlefarmer.name === name)
//     },
//
// };
//
// // Actions
// const actions = {
//     async getAllArticleFarmers(context){
//         context.commit(FETCH_START);
//         return ArticleFarmerService.getAll()
//             .then(({ data }) => {
//                 // console.log(data.data);
//                 context.commit(SET_ARTICLEFARMERS, data.data);
//                 context.commit(FETCH_END);
//             })
//             .catch(error => {
//                 throw new Error(error)
//             })
//     },
//
//     //get single Role
//     async getArticleFarmer(context, articlefarmerSlug) {
//         if (state.articlefarmers.id === articlefarmerSlug) {
//             return;
//         }
//
//         context.commit(FETCH_START);
//         return ArticleFarmerService.get(articlefarmerSlug)
//             .then(({data}) => {
//                 context.commit(SET_ARTICLEFARMER, data.data);
//                 context.commit(FETCH_END);
//             })
//             .catch(error => {
//                 throw error
//             });
//     },
//
//     createArticleFarmer(context, payload) {
//         return ArticleFarmerService.create(payload)
//             .then(({data}) => {
//                 // console.log(data.data);
//                 context.commit(SET_ARTICLEFARMER, data.data);
//             }).catch( (error) => {
//                 throw error
//             })
//     },
//
//     updateArticleFarmer(context, payload) {
//         // console.log(payload.farmerid);
//         return ArticleFarmerService.update(payload.farmerid, payload)
//             .then(({data}) => {
//                 // console.log(data);
//                 context.commit(SET_ARTICLEFARMER, data);
//             }).catch( (error) => {
//                 throw error
//             })
//     },
// };
//
// // Mutations
// const mutations = {
//     [FETCH_START](state) {
//         state.isLoading = true;
//     },
//     [FETCH_END](state) {
//         state.isLoading = false;
//     },
//     [SET_ARTICLEFARMERS](state, articlefarmers){
//         state.articlefarmers = articlefarmers;
//         state.articlefarmersCount = articlefarmers.length;
//     },
//     [SET_ARTICLEFARMER](state, articlefarmer){
//         state.articlefarmer = articlefarmer;
//     },
//     setCalculation(state, calculation){
//         //console.log(calculation);
//         state.calculation = calculation
//     }
// };
//
// export default {
//     state,
//     getters,
//     actions,
//     mutations
// }
