import axios from "axios";
const state = () => ({
    infosDiasporaStatus:null,
    infosDiasporaMessage:null,
    infosDiasporaData:[],

    infosAfriqueStatus:null,
    infosAfriqueMessage:null,
    infosAfriqueData:[],

    infosMondeStatus:null,
    infosMondeMessage:null,
    infosMondeData:[],
});
const getters = {

    getInfosDiasporaStatus(state){
        return state.infosDiasporaStatus;
    },

    getInfosDiasporaMessage(state){
        return state.infosDiasporaMessage;
    },

    getInfosDiasporaData(state){
        return state.infosDiasporaData;
    },

    getInfosAfriqueStatus(state){
        return state.infosAfriqueStatus;
    },

    getInfosAfriqueMessage(state){
        return state.infosAfriqueMessage;
    },

    getInfosAfriqueData(state){
        return state.infosAfriqueData;
    },


    getInfosMondeStatus(state){
        return state.infosMondeStatus;
    },

    getInfosMondeMessage(state){
        return state.infosMondeMessage;
    },

    getInfosMondeData(state){
        return state.infosMondeData;
    },
   
}

const actions = {
    async diasporaDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/diaspora").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosDiasporaStatus", "success");
            commit("setInfosDiasporaMessage", response.data.message);
            commit("setInfosDiasporaData", response.data.data.diasporaData);
        }else if(response.data.data.status == 401) {
            commit("setInfosDiasporaStatus", "empty");
            commit("setInfosDiasporaMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosDiasporaStatus", "error");
            commit("setInfosDiasporaMessage", response.data.message);
        }
    },

    async afriqueDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/afrique").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosAfriqueStatus", "success");
            commit("setInfosAfriqueMessage", response.data.message);
            commit("setInfosAfriqueData", response.data.data.afriqueData);
        }else if(response.data.data.status == 401) {
            commit("setInfosAfriqueStatus", "empty");
            commit("setInfosAfriqueMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosAfriqueStatus", "error");
            commit("setInfosAfriqueMessage", response.data.message);
        }
    },

    async mondeDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/monde").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosMondeStatus", "success");
            commit("setInfosMondeMessage", response.data.message);
            commit("setInfosMondeData", response.data.data.mondeData);
        }else if(response.data.data.status == 401) {
            commit("setInfosMondeStatus", "empty");
            commit("setInfosMondeMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosMondeStatus", "error");
            commit("setInfosMondeMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosDiasporaStatus(state, value){
        state.infosDiasporaStatus = value;
    },

    setInfosDiasporaMessage(state, value){
        state.infosDiasporaMessage = value;
    },

    setInfosDiasporaData(state, value){
        state.infosDiasporaData = value;
    },

    setInfosAfriqueStatus(state, value){
        state.infosAfriqueStatus = value;
    },

    setInfosAfriqueMessage(state, value){
        state.infosAfriqueMessage = value;
    },

    setInfosAfriqueData(state, value){
        state.infosAfriqueData = value;
    },


    setInfosMondeStatus(state, value){
        state.infosMondeStatus = value;
    },

    setInfosMondeMessage(state, value){
        state.infosMondeMessage = value;
    },

    setInfosMondeData(state, value){
        state.infosMondeData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
