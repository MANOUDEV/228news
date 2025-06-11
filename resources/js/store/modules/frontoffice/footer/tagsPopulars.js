import axios from "axios";
const state = () => ({
    infosTagsPopularsStatus:null,
    infosTagsPopularsMessage:null,
    infosTagsPopularsData:[],
});
const getters = {

    getInfosTagsPopularsStatus(state){
        return state.infosTagsPopularsStatus;
    },

    getInfosTagsPopularsMessage(state){
        return state.infosTagsPopularsMessage;
    },

    getInfosTagsPopularsData(state){
        return state.infosTagsPopularsData;
    },

}

const actions = {
    async tagsPopularsDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/footer/tags_populars").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTagsPopularsStatus", "success");
            commit("setInfosTagsPopularsMessage", response.data.message);
            commit("setInfosTagsPopularsData", response.data.data.tagsPopularsData);
        }else if(response.data.data.status == 401) {
            commit("setInfosTagsPopularsStatus", "empty");
            commit("setInfosTagsPopularsMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTagsPopularsStatus", "error");
            commit("setInfosTagsPopularsMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosTagsPopularsStatus(state, value){
        state.infosTagsPopularsStatus = value;
    },

    setInfosTagsPopularsMessage(state, value){
        state.infosTagsPopularsMessage = value;
    },

    setInfosTagsPopularsData(state, value){
        state.infosTagsPopularsData = value;
    },

}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
