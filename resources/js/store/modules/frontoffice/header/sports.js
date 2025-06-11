import axios from "axios";
const state = () => ({
    infosSportsStatus:null,
    infosSportsMessage:null,
    infosSportsData:[],
});
const getters = {

    getInfosSportsStatus(state){
        return state.infosSportsStatus;
    },

    getInfosSportsMessage(state){
        return state.infosSportsMessage;
    },

    getInfosSportsData(state){
        return state.infosSportsData;
    },
   
}

const actions = {
    async sportsDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/header/sports").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosSportsStatus", "success");
            commit("setInfosSportsMessage", response.data.message);
            commit("setInfosSportsData", response.data.data.sportsData);
        }else if(response.data.data.status == 401) {
            commit("setInfosSportsStatus", "empty");
            commit("setInfosSportsMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosSportsStatus", "error");
            commit("setInfosSportsMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosSportsStatus(state, value){
        state.infosSportsStatus = value;
    },

    setInfosSportsMessage(state, value){
        state.infosSportsMessage = value;
    },

    setInfosSportsData(state, value){
        state.infosSportsData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
