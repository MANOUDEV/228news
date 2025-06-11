import axios from "axios";
const state = () => ({
    infosCategoryPopularsStatus:null,
    infosCategoryPopularsMessage:null,
    infosCategoryPopularsData:[],
});
const getters = {

    getInfosCategoryPopularsStatus(state){
        return state.infosCategoryPopularsStatus;
    },

    getInfosCategoryPopularsMessage(state){
        return state.infosCategoryPopularsMessage;
    },

    getInfosCategoryPopularsData(state){
        return state.infosCategoryPopularsData;
    },

}

const actions = {
    async categoryPopularsDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/footer/category_populars").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCategoryPopularsStatus", "success");
            commit("setInfosCategoryPopularsMessage", response.data.message);
            commit("setInfosCategoryPopularsData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosCategoryPopularsStatus", "empty");
            commit("setInfosCategoryPopularsMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCategoryPopularsStatus", "error");
            commit("setInfosCategoryPopularsMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosCategoryPopularsStatus(state, value){
        state.infosCategoryPopularsStatus = value;
    },

    setInfosCategoryPopularsMessage(state, value){
        state.infosCategoryPopularsMessage = value;
    },

    setInfosCategoryPopularsData(state, value){
        state.infosCategoryPopularsData = value;
    },

}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
