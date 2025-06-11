import axios from "axios";
const state = () => ({
    infosPolitiqueStatus:null,
    infosPolitiqueMessage:null,
    infosPolitiqueData:[],
});
const getters = {

    getInfosPolitiqueStatus(state){
        return state.infosPolitiqueStatus;
    },

    getInfosPolitiqueMessage(state){
        return state.infosPolitiqueMessage;
    },

    getInfosPolitiqueData(state){
        return state.infosPolitiqueData;
    },

}

const actions = {
    async politiqueDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/politique").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosPolitiqueStatus", "success");
            commit("setInfosPolitiqueMessage", response.data.message);
            commit("setInfosPolitiqueData", response.data.data.politiqueData);
        }else if(response.data.data.status == 401) {
            commit("setInfosPolitiqueStatus", "empty");
            commit("setInfosPolitiqueMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosPolitiqueStatus", "error");
            commit("setInfosPolitiqueMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosPolitiqueStatus(state, value){
        state.infosPolitiqueStatus = value;
    },

    setInfosPolitiqueMessage(state, value){
        state.infosPolitiqueMessage = value;
    },

    setInfosPolitiqueData(state, value){
        state.infosPolitiqueData = value;
    },
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
