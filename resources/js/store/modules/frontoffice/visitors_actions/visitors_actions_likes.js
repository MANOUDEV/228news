import axios from "axios";
const state = () => ({
    infosCreateVisitorLikesStatus:null,
    infosCreateVisitorLikesMessage:null,
    infosCreateVisitorLikesData:[],

    infosCheckVisitorLikesStatus:null,
    infosCheckVisitorLikesMessage:null,
    infosCheckVisitorLikesData:[],
});
const getters = {

    getInfosCreateVisitorLikesStatus(state){
        return state.infosCreateVisitorLikesStatus;
    },

    getInfosCreateVisitorLikesMessage(state){
        return state.infosCreateVisitorLikesMessage;
    },

    getInfosCreateVisitorLikesData(state){
        return state.infosCreateVisitorLikesData;
    },

    getInfosCheckVisitorLikesStatus(state){
        return state.infosCheckVisitorLikesStatus;
    },

    getInfosCheckVisitorLikesMessage(state){
        return state.infosCheckVisitorLikesMessage;
    },

    getInfosCheckVisitorLikesData(state){
        return state.infosCheckVisitorLikesData;
    },

}

const actions = {
    async createVisitorLikesDataRequest({ commit }) {
        const response = await axios.post("/api/home/visitor/create_likes").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCreateVisitorLikesStatus", "success");
            commit("setInfosCreateVisitorLikesMessage", response.data.message);
            commit("setInfosCreateVisitorLikesData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosCreateVisitorLikesStatus", "empty");
            commit("setInfosCreateVisitorLikesMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCreateVisitorLikesStatus", "error");
            commit("setInfosCreateVisitorLikesMessage", response.data.message);
        }
    },

    async checkVisitorLikesDataRequest({ commit }, payload) {
        const response = await axios.get(`/api/home/visitor/${localStorage.getItem('mtrl')}/check_likes`).catch((err) => { console.log(err);});
       if(response.data.data.status == 401) {
            commit("setInfosCheckVisitorLikesStatus", "empty");
            commit("setInfosCheckVisitorLikesMessage", response.data.message);
        }if(response.data.data.status == 200) {
            commit("setInfosCheckVisitorLikesStatus", "success");
            commit("setInfosCheckVisitorLikesMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosCreateVisitorLikesStatus(state, value){
        state.infosCreateVisitorLikesStatus = value;
    },

    setInfosCreateVisitorLikesMessage(state, value){
        state.infosCreateVisitorLikesMessage = value;
    },

    setInfosCreateVisitorLikesData(state, value){
        state.infosCreateVisitorLikesData = value;
    },

    setInfosCheckVisitorLikesStatus(state, value){
        state.infosCheckVisitorLikesStatus = value;
    },

    setInfosCheckVisitorLikesMessage(state, value){
        state.infosCheckVisitorLikesMessage = value;
    },

    setInfosCheckVisitorLikesData(state, value){
        state.infosCheckVisitorLikesData = value;
    },
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
