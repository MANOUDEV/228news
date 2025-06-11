import axios from "axios";
const state = () => ({
    infosChroniquesStatus:null,
    infosChroniquesMessage:null,
    infosChroniquesData:[],

    infosCommuniqueStatus:null,
    infosCommuniqueMessage:null,
    infosCommuniqueData:[],

    infosEconomieStatus:null,
    infosEconomieMessage:null,
    infosEconomieData:[],
});
const getters = {

    getInfosChroniquesStatus(state){
        return state.infosChroniquesStatus;
    },

    getInfosChroniquesMessage(state){
        return state.infosChroniquesMessage;
    },

    getInfosChroniquesData(state){
        return state.infosChroniquesData;
    },

    getInfosCommuniqueStatus(state){
        return state.infosCommuniqueStatus;
    },

    getInfosCommuniqueMessage(state){
        return state.infosCommuniqueMessage;
    },

    getInfosCommuniqueData(state){
        return state.infosCommuniqueData;
    },


    getInfosEconomieStatus(state){
        return state.infosEconomieStatus;
    },

    getInfosEconomieMessage(state){
        return state.infosEconomieMessage;
    },

    getInfosEconomieData(state){
        return state.infosEconomieData;
    },
   
}

const actions = {
    async chroniquesDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/chroniques").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosChroniquesStatus", "success");
            commit("setInfosChroniquesMessage", response.data.message);
            commit("setInfosChroniquesData", response.data.data.chroniquesData);
        }else if(response.data.data.status == 401) {
            commit("setInfosChroniquesStatus", "empty");
            commit("setInfosChroniquesMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosChroniquesStatus", "error");
            commit("setInfosChroniquesMessage", response.data.message);
        }
    },

    async communiqueDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/communique").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCommuniqueStatus", "success");
            commit("setInfosCommuniqueMessage", response.data.message);
            commit("setInfosCommuniqueData", response.data.data.communiqueData);
        }else if(response.data.data.status == 401) {
            commit("setInfosCommuniqueStatus", "empty");
            commit("setInfosCommuniqueMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCommuniqueStatus", "error");
            commit("setInfosCommuniqueMessage", response.data.message);
        }
    },

    async economieDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/economie").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosEconomieStatus", "success");
            commit("setInfosEconomieMessage", response.data.message);
            commit("setInfosEconomieData", response.data.data.economieData);
        }else if(response.data.data.status == 401) {
            commit("setInfosEconomieStatus", "empty");
            commit("setInfosEconomieMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosEconomieStatus", "error");
            commit("setInfosEconomieMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosChroniquesStatus(state, value){
        state.infosChroniquesStatus = value;
    },

    setInfosChroniquesMessage(state, value){
        state.infosChroniquesMessage = value;
    },

    setInfosChroniquesData(state, value){
        state.infosChroniquesData = value;
    },

    setInfosCommuniqueStatus(state, value){
        state.infosCommuniqueStatus = value;
    },

    setInfosCommuniqueMessage(state, value){
        state.infosCommuniqueMessage = value;
    },

    setInfosCommuniqueData(state, value){
        state.infosCommuniqueData = value;
    },


    setInfosEconomieStatus(state, value){
        state.infosEconomieStatus = value;
    },

    setInfosEconomieMessage(state, value){
        state.infosEconomieMessage = value;
    },

    setInfosEconomieData(state, value){
        state.infosEconomieData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
