import jwtInterceptor  from '../../../../shared/jwtInterceptor';
const state = () => ({
    infosTagsListStatus:null,
    infosTagsListMessage:null,
    infosTagsListData:[],

    infosSearchByDateListStatus:null,
    infosSearchByDateListMessage:null,
    infosSearchByDateListData:[],

    infosTagsShowStatus:null,
    infosTagsShowMessage:null,
    infosTagsShowData:[],

    infosTagsStoreStatus:null,
    infosTagsStoreMessage:null,
    infosTagsStoreData:[],
    infosTagsStoreErrors:[],

    infosTagsUpdateStatus:null,
    infosTagsUpdateMessage:null,
    infosTagsUpdateData:[],
    infosTagsUpdateErrors:[],

    infosTagsDeleteStatus:null,
    infosTagsDeleteMessage:null,
    infosTagsDeleteData:[],
});
const getters = {

    getInfosSearchByDateListStatus(state){
        return state.infosSearchByDateListStatus;
    },

    getInfosSearchByDateListMessage(state){
        return state.infosSearchByDateListMessage;
    },

    getInfosSearchByDateListData(state){
        return state.infosSearchByDateListData;
    },

    getInfosTagsListStatus(state){
        return state.infosTagsListStatus;
    },

    getInfosTagsListMessage(state){
        return state.infosTagsListMessage;
    },

    getInfosTagsListData(state){
        return state.infosTagsListData;
    },

    getInfosTagsShowStatus(state){
        return state.infosTagsShowStatus;
    },

    getInfosTagsShowMessage(state){
        return state.infosTagsShowMessage;
    },

    getInfosTagsShowData(state){
        return state.infosTagsShowData;
    },

    getInfosTagsStoreStatus(state){
        return state.infosTagsStoreStatus;
    },

    getInfosTagsStoreMessage(state){
        return state.infosTagsStoreMessage;
    },

    getInfosTagsStoreErrors(state){
        return state.infosTagsStoreErrors;
    },

    getInfosTagsStoreData(state){
        return state.infosTagsStoreData;
    },

    getInfosTagsUpdateStatus(state){
        return state.infosTagsUpdateStatus;
    },

    getInfosTagsUpdateMessage(state){
        return state.infosTagsUpdateMessage;
    },

    getInfosTagsUpdateErrors(state){
        return state.infosTagsUpdateErrors;
    },

    getInfosTagsUpdateData(state){
        return state.infosTagsUpdateData;
    },

    getInfosTagsDeleteStatus(state){
        return state.infosTagsDeleteStatus;
    },

    getInfosTagsDeleteMessage(state){
        return state.infosTagsDeleteMessage;
    },

    getInfosTagsDeleteData(state){
        return state.infosTagsDeleteData;
    },
   
}

const actions = {
    async tagsListDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/publicator/tags_list?page=${payload.page}&search=${payload.search}`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTagsListStatus", "success");
            commit("setInfosTagsListMessage", response.data.message);
            commit("setInfosTagsListData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTagsListStatus", "empty");
            commit("setInfosTagsListData", response.data.data);
            commit("setInfosTagsListMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTagsListStatus", "error");
            commit("setInfosTagsListMessage", response.data.message);
        }
    },

    async tagsListHDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/publicator/tags_search_by_date_infos?page=${payload.page}&searchH=${payload.searchH}`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTagsListStatus", "success");
            commit("setInfosTagsListMessage", response.data.message);
            commit("setInfosTagsListData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTagsListStatus", "empty");
            commit("setInfosTagsListData", response.data.data);
            commit("setInfosTagsListMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTagsListStatus", "error");
            commit("setInfosTagsListMessage", response.data.message);
        }
    },

    async searchByDateListDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/publicator/tags_search_by_date`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosSearchByDateListStatus", "success");
            commit("setInfosSearchByDateListMessage", response.data.message);
            commit("setInfosSearchByDateListData", response.data.data.infosMonthYearTags);
        }else if(response.data.data.status == 401) {
            commit("setInfosSearchByDateListStatus", "empty");
            commit("setInfosSearchByDateListData", response.data.data);
            commit("setInfosSearchByDateListMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosSearchByDateListStatus", "error");
            commit("setInfosSearchByDateListMessage", response.data.message);
        }
    },

    async tagsShowDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get("backoffice/publicator/tags_show", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTagsShowStatus", "success");
            commit("setInfosTagsShowMessage", response.data.message);
            commit("setInfosTagsShowData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTagsShowStatus", "empty");
            commit("setInfosTagsListData", response.data.data);
            commit("setInfosTagsShowMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTagsShowStatus", "error");
            commit("setInfosTagsShowMessage", response.data.message);
        }
    },

    async tagsStoreDataRequest({ commit },  payload) {
        const response = await jwtInterceptor.post("backoffice/publicator/tags_store", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTagsStoreStatus", "success");
            commit("setInfosTagsStoreMessage", response.data.message);
            commit("setInfosTagsStoreData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTagsStoreStatus", "empty");
            commit("setInfosTagsStoreErrors", response.data.data.errors);
            commit("setInfosTagsStoreMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTagsStoreStatus", "error");
            commit("setInfosTagsStoreMessage", response.data.message);
        }
    },

    async tagsUpdateDataRequest({ commit },  payload) {
        const response = await jwtInterceptor.put(`backoffice/publicator/${payload.slug}/tags_update`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTagsUpdateStatus", "success");
            commit("setInfosTagsUpdateMessage", response.data.message);
            commit("setInfosTagsUpdateData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTagsUpdateStatus", "empty");
            commit("setInfosTagsUpdateErrors", response.data.data.errors);
            commit("setInfosTagsUpdateMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTagsUpdateStatus", "error");
            commit("setInfosTagsUpdateMessage", response.data.message);
        }
    },

    async tagsDeleteDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.delete(`backoffice/publicator/${payload.slug}/tags_delete`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTagsDeleteStatus", "success");
            commit("setInfosTagsDeleteMessage", response.data.message);
            commit("setInfosTagsDeleteData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTagsDeleteStatus", "empty");
            commit("setInfosTagsDeleteMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTagsDeleteStatus", "error");
            commit("setInfosTagsDeleteMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosTagsListStatus(state, value){
        state.infosTagsListStatus = value;
    },

    setInfosTagsListMessage(state, value){
        state.infosTagsListMessage = value;
    },

    

    setInfosTagsListData(state, value){
        state.infosTagsListData = value;
    },

    setInfosSearchByDateListStatus(state, value){
        state.infosSearchByDateListStatus = value;
    },

    setInfosSearchByDateListMessage(state, value){
        state.infosSearchByDateListMessage = value;
    },

    setInfosSearchByDateListData(state, value){
        state.infosSearchByDateListData = value;
    },


    

    setInfosTagsShowStatus(state, value){
        state.infosTagsShowStatus = value;
    },

    setInfosTagsShowMessage(state, value){
        state.infosTagsShowMessage = value;
    },

    setInfosTagsShowData(state, value){
        state.infosTagsShowData = value;
    },

    setInfosTagsStoreStatus(state, value){
        state.infosTagsStoreStatus = value;
    },

    setInfosTagsStoreErrors(state, value){
        state.infosTagsStoreErrors = value;
    },

    setInfosTagsStoreMessage(state, value){
        state.infosTagsStoreMessage = value;
    },

    setInfosTagsStoreData(state, value){
        state.infosTagsStoreData = value;
    },

    setInfosTagsUpdateStatus(state, value){
        state.infosTagsUpdateStatus = value;
    },

    setInfosTagsUpdateMessage(state, value){
        state.infosTagsUpdateMessage = value;
    },

    setInfosTagsUpdateErrors(state, value){
        state.infosTagsUpdateErrors = value;
    },

    setInfosTagsUpdateData(state, value){
        state.infosTagsUpdateData = value;
    },
   
    setInfosTagsDeleteStatus(state, value){
        state.infosTagsDeleteStatus = value;
    },

    setInfosTagsDeleteMessage(state, value){
        state.infosTagsDeleteMessage = value;
    },

    setInfosTagsDeleteData(state, value){
        state.infosTagsDeleteData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
