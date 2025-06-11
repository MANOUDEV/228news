import axios from "axios";
const state = () => ({
    infosSocieteStatus:null,
    infosSocieteMessage:null,
    infosSocieteData:[],
});
const getters = {

    getInfosSocieteStatus(state){
        return state.infosSocieteStatus;
    },

    getInfosSocieteMessage(state){
        return state.infosSocieteMessage;
    },

    getInfosSocieteData(state){
        return state.infosSocieteData;
    },
   
}

const actions = {
    async societeDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/societe").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosSocieteStatus", "success");
            commit("setInfosSocieteMessage", response.data.message);
            commit("setInfosSocieteData", response.data.data.societeData);
        }else if(response.data.data.status == 401) {
            commit("setInfosSocieteStatus", "empty");
            commit("setInfosSocieteMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosSocieteStatus", "error");
            commit("setInfosSocieteMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosSocieteStatus(state, value){
        state.infosSocieteStatus = value;
    },

    setInfosSocieteMessage(state, value){
        state.infosSocieteMessage = value;
    },

    setInfosSocieteData(state, value){
        state.infosSocieteData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
