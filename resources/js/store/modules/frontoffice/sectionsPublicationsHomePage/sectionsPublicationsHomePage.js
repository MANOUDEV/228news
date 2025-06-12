import axios from "axios";
const state = () => ({
    infosTogoPolitiqueStatus:null,
    infosTogoPolitiqueMessage:null,
    infosTogoPolitiqueData:[],
    infosANePasManquerTogoStatus:null,
    infosANePasManquerTogoMessage:null,
    infosANePasManquerTogoData:[],
    infosInternationalFenetreSurLAfriqueSportsStatus:null,
    infosInternationalFenetreSurLAfriqueSportsMessage:null,
    infosInternationalFenetreSurLAfriqueSportsData:[],
    infosSocieteStatus:null,
    infosSocieteMessage:null,
    infosSocieteData:[],
    infosOpinionFaitsDiversStatus:null,
    infosOpinionFaitsDiversMessage:null,
    infosOpinionFaitsDiversData:[],
    infosImportantStatus:null,
    infosImportantMessage:null,
    infosImportantData:[],
    infosCommentsPopularsStatus:null,
    infosCommentsPopularsMessage:null,
    infosCommentsPopularsData:[],
});
const getters = {

    getInfosTogoPolitiqueStatus(state){
        return state.infosTogoPolitiqueStatus;
    },

    getInfosTogoPolitiqueMessage(state){
        return state.infosTogoPolitiqueMessage;
    },

    getInfosTogoPolitiqueData(state){
        return state.infosTogoPolitiqueData;
    },

    getInfosANePasManquerTogoStatus(state){
        return state.infosANePasManquerTogoStatus;
    },

    getInfosANePasManquerTogoMessage(state){
        return state.infosANePasManquerTogoMessage;
    },

    getInfosANePasManquerTogoData(state){
        return state.infosANePasManquerTogoData;
    },

    getInfosSocieteStatus(state){
        return state.infosSocieteStatus;
    },

    getInfosSocieteMessage(state){
        return state.infosSocieteMessage;
    },

    getInfosSocieteData(state){
        return state.infosSocieteData;
    },

    getInfosInternationalFenetreSurLAfriqueSportsStatus(state){
        return state.infosInternationalFenetreSurLAfriqueSportsStatus;
    },

    getInfosInternationalFenetreSurLAfriqueSportsMessage(state){
        return state.infosInternationalFenetreSurLAfriqueSportsMessage;
    },

    getInfosInternationalFenetreSurLAfriqueSportsData(state){
        return state.infosInternationalFenetreSurLAfriqueSportsData;
    },

    getInfosOpinionFaitsDiversStatus(state){
        return state.infosOpinionFaitsDiversStatus;
    },

    getInfosOpinionFaitsDiversMessage(state){
        return state.infosOpinionFaitsDiversMessage;
    },

    getInfosOpinionFaitsDiversData(state){
        return state.infosOpinionFaitsDiversData;
    },

    getInfosImportantStatus(state){
        return state.infosImportantStatus;
    },

    getInfosImportantMessage(state){
        return state.infosImportantMessage;
    },

    getInfosImportantData(state){
        return state.infosImportantData;
    },

    getInfosCommentsPopularsStatus(state){
        return state.infosCommentsPopularsStatus;
    },

    getInfosCommentsPopularsMessage(state){
        return state.infosCommentsPopularsMessage;
    },

    getInfosCommentsPopularsData(state){
        return state.infosCommentsPopularsData;
    },
}

const actions = {
    async togoPolitiqueDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/home_page/togo_politique").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTogoPolitiqueStatus", "success");
            commit("setInfosTogoPolitiqueMessage", response.data.message);
            commit("setInfosTogoPolitiqueData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTogoPolitiqueStatus", "empty");
            commit("setInfosTogoPolitiqueMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTogoPolitiqueStatus", "error");
            commit("setInfosTogoPolitiqueMessage", response.data.message);
        }
    },

    async aNePasManquerTogoDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/home_page/a_ne_pas_manquer_togo").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosANePasManquerTogoStatus", "success");
            commit("setInfosANePasManquerTogoMessage", response.data.message);
            commit("setInfosANePasManquerTogoData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosANePasManquerTogoStatus", "empty");
            commit("setInfosANePasManquerTogoMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosANePasManquerTogoStatus", "error");
            commit("setInfosANePasManquerTogoMessage", response.data.message);
        }
    },

    async internationalFenetreSurLAfriqueSportsDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/home_page/international_fenetre_afrique_sports").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosInternationalFenetreSurLAfriqueSportsStatus", "success");
            commit("setInfosInternationalFenetreSurLAfriqueSportsMessage", response.data.message);
            commit("setInfosInternationalFenetreSurLAfriqueSportsData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosInternationalFenetreSurLAfriqueSportsStatus", "empty");
            commit("setInfosInternationalFenetreSurLAfriqueSportsMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosInternationalFenetreSurLAfriqueSportsStatus", "error");
            commit("setInfosInternationalFenetreSurLAfriqueSportsMessage", response.data.message);
        }
    },

    async societeDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/home_page/societe").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosSocieteStatus", "success");
            commit("setInfosSocieteMessage", response.data.message);
            commit("setInfosSocieteData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosSocieteStatus", "empty");
            commit("setInfosSocieteMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosSocieteStatus", "error");
            commit("setInfosSocieteMessage", response.data.message);
        }
    },

    async opinionFaitsDiversDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/home_page/opinion_faits_divers").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosOpinionFaitsDiversStatus", "success");
            commit("setInfosOpinionFaitsDiversMessage", response.data.message);
            commit("setInfosOpinionFaitsDiversData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosOpinionFaitsDiversStatus", "empty");
            commit("setInfosOpinionFaitsDiversMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosOpinionFaitsDiversStatus", "error");
            commit("setInfosOpinionFaitsDiversMessage", response.data.message);
        }
    },

    async importantDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/home_page/important").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosImportantStatus", "success");
            commit("setInfosImportantMessage", response.data.message);
            commit("setInfosImportantData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosImportantStatus", "empty");
            commit("setInfosImportantMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosImportantStatus", "error");
            commit("setInfosImportantMessage", response.data.message);
        }
    },

    async commentsPopularsDataRequest({ commit }) {
        const response = await axios.get("/api/frontoffice/home_page/populars_comments").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCommentsPopularsStatus", "success");
            commit("setInfosCommentsPopularsMessage", response.data.message);
            commit("setInfosCommentsPopularsData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosCommentsPopularsStatus", "empty");
            commit("setInfosCommentsPopularsMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCommentsPopularsStatus", "error");
            commit("setInfosCommentsPopularsMessage", response.data.message);
        }
    },
}

const mutations = {

    setInfosTogoPolitiqueStatus(state, value){
        state.infosTogoPolitiqueStatus = value;
    },

    setInfosTogoPolitiqueMessage(state, value){
        state.infosTogoPolitiqueMessage = value;
    },

    setInfosTogoPolitiqueData(state, value){
        state.infosTogoPolitiqueData = value;
    },

    setInfosANePasManquerTogoStatus(state, value){
        state.infosANePasManquerTogoStatus = value;
    },

    setInfosANePasManquerTogoMessage(state, value){
        state.infosANePasManquerTogoMessage = value;
    },

    setInfosANePasManquerTogoData(state, value){
        state.infosANePasManquerTogoData = value;
    },

    setInfosInternationalFenetreSurLAfriqueSportsStatus(state, value){
        state.infosInternationalFenetreSurLAfriqueSportsStatus = value;
    },
    
    setInfosInternationalFenetreSurLAfriqueSportsMessage(state, value){
        state.infosInternationalFenetreSurLAfriqueSportsMessage = value;
    },

    setInfosInternationalFenetreSurLAfriqueSportsData(state, value){
        state.infosInternationalFenetreSurLAfriqueSportsData = value;
    },

    setInfosSocieteStatus(state, value){
        state.infosSocieteStatus = value;
    },
    
    setInfosSocieteMessage(state, value){
        state.infosSocieteMessage = value;
    },

    setInfosSocieteData(state, value){
        state.infosSocieteData = value;
    },

    setInfosOpinionFaitsDiversStatus(state, value){
        state.infosOpinionFaitsDiversStatus = value;
    },

    setInfosOpinionFaitsDiversMessage(state, value){
        state.infosOpinionFaitsDiversMessage = value;
    },

    setInfosOpinionFaitsDiversData(state, value){
        state.infosOpinionFaitsDiversData = value;
    },

    setInfosImportantStatus(state, value){
        state.infosImportantStatus = value;
    },

    setInfosImportantMessage(state, value){
        state.infosImportantMessage = value;
    },

    setInfosImportantData(state, value){
        state.infosImportantData = value;
    },

    setInfosCommentsPopularsStatus(state, value){
        state.infosCommentsPopularsStatus = value;
    },

    setInfosCommentsPopularsMessage(state, value){
        state.infosCommentsPopularsMessage = value;
    },

    setInfosCommentsPopularsData(state, value){
        state.infosCommentsPopularsData = value;
    },
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
