import axios from "axios";
const state = () => ({
    infosCreateVisitorCommentsStatus:null,
    infosCreateVisitorCommentsMessage:null,
    infosCreateVisitorCommentsData:[],

    infosCheckVisitorCommentsStatus:null,
    infosCheckVisitorCommentsMessage:null,
    infosCheckVisitorCommentsData:[],
});
const getters = {

    getInfosCreateVisitorCommentsStatus(state){
        return state.infosCreateVisitorCommentsStatus;
    },

    getInfosCreateVisitorCommentsMessage(state){
        return state.infosCreateVisitorCommentsMessage;
    },

    getInfosCreateVisitorCommentsData(state){
        return state.infosCreateVisitorCommentsData;
    },

    getInfosCheckVisitorCommentsStatus(state){
        return state.infosCheckVisitorCommentsStatus;
    },

    getInfosCheckVisitorCommentsMessage(state){
        return state.infosCheckVisitorCommentsMessage;
    },

    getInfosCheckVisitorCommentsData(state){
        return state.infosCheckVisitorCommentsData;
    },

}

const actions = {
    async createVisitorCommentsDataRequest({ commit }) {
        const response = await axios.post("/api/home/visitor/create_comments").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCreateVisitorCommentsStatus", "success");
            commit("setInfosCreateVisitorCommentsMessage", response.data.message);
            commit("setInfosCreateVisitorCommentsData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosCreateVisitorCommentsStatus", "empty");
            commit("setInfosCreateVisitorCommentsMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCreateVisitorCommentsStatus", "error");
            commit("setInfosCreateVisitorCommentsMessage", response.data.message);
        }
    },

    async checkVisitorCommentsDataRequest({ commit }, payload) {
        const response = await axios.get(`/api/home/visitor/${localStorage.getItem('mtrc')}/check_comments`).catch((err) => { console.log(err);});
       if(response.data.data.status == 401) {
            commit("setInfosCheckVisitorCommentsStatus", "empty");
            commit("setInfosCheckVisitorCommentsMessage", response.data.message);
        }if(response.data.data.status == 200) {
            commit("setInfosCheckVisitorCommentsStatus", "success");
            commit("setInfosCheckVisitorCommentsMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosCreateVisitorCommentsStatus(state, value){
        state.infosCreateVisitorCommentsStatus = value;
    },

    setInfosCreateVisitorCommentsMessage(state, value){
        state.infosCreateVisitorCommentsMessage = value;
    },

    setInfosCreateVisitorCommentsData(state, value){
        state.infosCreateVisitorCommentsData = value;
    },

    setInfosCheckVisitorCommentsStatus(state, value){
        state.infosCheckVisitorCommentsStatus = value;
    },

    setInfosCheckVisitorCommentsMessage(state, value){
        state.infosCheckVisitorCommentsMessage = value;
    },

    setInfosCheckVisitorCommentsData(state, value){
        state.infosCheckVisitorCommentsData = value;
    },
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
