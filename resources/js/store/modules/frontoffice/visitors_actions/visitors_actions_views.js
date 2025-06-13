import axios from "axios";
const state = () => ({
    infosCreateVisitorViewsStatus:null,
    infosCreateVisitorViewsMessage:null,
    infosCreateVisitorViewsData:[],

    infosCheckVisitorViewsStatus:null,
    infosCheckVisitorViewsMessage:null,
    infosCheckVisitorViewsData:[],
});
const getters = {

    getInfosCreateVisitorViewsStatus(state){
        return state.infosCreateVisitorViewsStatus;
    },

    getInfosCreateVisitorViewsMessage(state){
        return state.infosCreateVisitorViewsMessage;
    },

    getInfosCreateVisitorViewsData(state){
        return state.infosCreateVisitorViewsData;
    },

    getInfosCheckVisitorViewsStatus(state){
        return state.infosCheckVisitorViewsStatus;
    },

    getInfosCheckVisitorViewsMessage(state){
        return state.infosCheckVisitorViewsMessage;
    },

    getInfosCheckVisitorViewsData(state){
        return state.infosCheckVisitorViewsData;
    },

}

const actions = {
    async createVisitorViewsDataRequest({ commit }) {
        const response = await axios.post("/api/home/visitor/create_views").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCreateVisitorViewsStatus", "success");
            commit("setInfosCreateVisitorViewsMessage", response.data.message);
            commit("setInfosCreateVisitorViewsData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosCreateVisitorViewsStatus", "empty");
            commit("setInfosCreateVisitorViewsMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCreateVisitorViewsStatus", "error");
            commit("setInfosCreateVisitorViewsMessage", response.data.message);
        }
    },

    async checkVisitorViewsDataRequest({ commit }, payload) {
        const response = await axios.get(`/api/home/visitor/${localStorage.getItem('mtrv')}/check_views`).catch((err) => { console.log(err);});
       if(response.data.data.status == 401) {
            commit("setInfosCheckVisitorViewsStatus", "empty");
            commit("setInfosCheckVisitorViewsMessage", response.data.message);
        }if(response.data.data.status == 200) {
            commit("setInfosCheckVisitorViewsStatus", "success");
            commit("setInfosCheckVisitorViewsMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosCreateVisitorViewsStatus(state, value){
        state.infosCreateVisitorViewsStatus = value;
    },

    setInfosCreateVisitorViewsMessage(state, value){
        state.infosCreateVisitorViewsMessage = value;
    },

    setInfosCreateVisitorViewsData(state, value){
        state.infosCreateVisitorViewsData = value;
    },

    setInfosCheckVisitorViewsStatus(state, value){
        state.infosCheckVisitorViewsStatus = value;
    },

    setInfosCheckVisitorViewsMessage(state, value){
        state.infosCheckVisitorViewsMessage = value;
    },

    setInfosCheckVisitorViewsData(state, value){
        state.infosCheckVisitorViewsData = value;
    },
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
