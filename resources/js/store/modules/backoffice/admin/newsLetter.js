import jwtInterceptor  from '../../../../shared/jwtInterceptor';
const state = () => ({
    infosNewsLetterListStatus:null,
    infosNewsLetterListMessage:null,
    infosNewsLetterListData:[],

    infosNewsLetterSearchStatus:null,
    infosNewsLetterSearchMessage:null,
    infosNewsLetterSearchData:[],

    infosNewsLetterShowStatus:null,
    infosNewsLetterShowMessage:null,
    infosNewsLetterShowData:[],

    infosNewsLetterStoreStatus:null,
    infosNewsLetterStoreMessage:null,
    infosNewsLetterStoreData:[],
    infosNewsLetterStoreErrors:[],

    infosNewsLetterUpdateStatus:null,
    infosNewsLetterUpdateMessage:null,
    infosNewsLetterUpdateData:[],
    infosNewsLetterUpdateErrors:[],

    infosNewsLetterDeleteStatus:null,
    infosNewsLetterDeleteMessage:null,
    infosNewsLetterDeleteData:[],

    infosNewsLetterActivateStatus:null,
    infosNewsLetterActivateMessage:null,
    infosNewsLetterActivateData:[],

    infosNewsLetterBlockStatus:null,
    infosNewsLetterBlockMessage:null,
    infosNewsLetterBlockData:[],
});
const getters = {

    getInfosNewsLetterListStatus(state){
        return state.infosNewsLetterListStatus;
    },

    getInfosNewsLetterListMessage(state){
        return state.infosNewsLetterListMessage;
    },

    getInfosNewsLetterListData(state){
        return state.infosNewsLetterListData;
    },

    getInfosNewsLetterSearchStatus(state){
        return state.infosNewsLetterSearchStatus;
    },

    getInfosNewsLetterSearchMessage(state){
        return state.infosNewsLetterSearchMessage;
    },

    getInfosNewsLetterSearchData(state){
        return state.infosNewsLetterSearchData;
    },

    getInfosNewsLetterShowStatus(state){
        return state.infosNewsLetterShowStatus;
    },

    getInfosNewsLetterShowMessage(state){
        return state.infosNewsLetterShowMessage;
    },

    getInfosNewsLetterShowData(state){
        return state.infosNewsLetterShowData;
    },

    getInfosNewsLetterStoreStatus(state){
        return state.infosNewsLetterStoreStatus;
    },

    getInfosNewsLetterStoreMessage(state){
        return state.infosNewsLetterStoreMessage;
    },

    getInfosNewsLetterStoreErrors(state){
        return state.infosNewsLetterStoreErrors;
    },

    getInfosNewsLetterStoreData(state){
        return state.infosNewsLetterStoreData;
    },

    getInfosNewsLetterUpdateStatus(state){
        return state.infosNewsLetterUpdateStatus;
    },

    getInfosNewsLetterUpdateMessage(state){
        return state.infosNewsLetterUpdateMessage;
    },

    getInfosNewsLetterUpdateErrors(state){
        return state.infosNewsLetterUpdateErrors;
    },

    getInfosNewsLetterUpdateData(state){
        return state.infosNewsLetterUpdateData;
    },

    getInfosNewsLetterDeleteStatus(state){
        return state.infosNewsLetterDeleteStatus;
    },

    getInfosNewsLetterDeleteMessage(state){
        return state.infosNewsLetterDeleteMessage;
    },

    getInfosNewsLetterDeleteData(state){
        return state.infosNewsLetterDeleteData;
    },

    getInfosNewsLetterActivateStatus(state){
        return state.infosNewsLetterActivateStatus;
    },

    getInfosNewsLetterActivateMessage(state){
        return state.infosNewsLetterActivateMessage;
    },

    getInfosNewsLetterActivateData(state){
        return state.infosNewsLetterActivateData;
    },

    getInfosNewsLetterBlockStatus(state){
        return state.infosNewsLetterBlockStatus;
    },

    getInfosNewsLetterBlockMessage(state){
        return state.infosNewsLetterBlockMessage;
    },

    getInfosNewsLetterBlockData(state){
        return state.infosNewsLetterBlockData;
    },
   
}

const actions = {
    async newsLetterListDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/admin/news_letters_list?page=${payload.page}&search=${payload.search}`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosNewsLetterListStatus", "success");
            commit("setInfosNewsLetterListMessage", response.data.message);
            commit("setInfosNewsLetterListData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosNewsLetterListStatus", "empty");
            commit("setInfosNewsLetterListData", response.data.data);
            commit("setInfosNewsLetterListMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosNewsLetterListStatus", "error");
            commit("setInfosNewsLetterListMessage", response.data.message);
        }
    },

    async newsLetterSearchDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/admin/${payload.status}/news_letters_search_by_status?page=${payload.page}`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosNewsLetterSearchStatus", "success");
            commit("setInfosNewsLetterSearchMessage", response.data.message);
            commit("setInfosNewsLetterSearchData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosNewsLetterSearchStatus", "empty");
            commit("setInfosNewsLetterSearchData", response.data.data);
            commit("setInfosNewsLetterSearchMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosNewsLetterSearchStatus", "error");
            commit("setInfosNewsLetterSearchMessage", response.data.message);
        }
    },

    async newsLetterShowDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get("backoffice/admin/news_letters_show", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosNewsLetterShowStatus", "success");
            commit("setInfosNewsLetterShowMessage", response.data.message);
            commit("setInfosNewsLetterShowData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosNewsLetterShowStatus", "empty");
            commit("setInfosNewsLetterListData", response.data.data);
            commit("setInfosNewsLetterShowMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosNewsLetterShowStatus", "error");
            commit("setInfosNewsLetterShowMessage", response.data.message);
        }
    },

    async newsLetterStoreDataRequest({ commit },  payload) {
        const response = await jwtInterceptor.post("backoffice/admin/news_letters_store", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosNewsLetterStoreStatus", "success");
            commit("setInfosNewsLetterStoreMessage", response.data.message);
            commit("setInfosNewsLetterStoreData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosNewsLetterStoreStatus", "empty");
            commit("setInfosNewsLetterStoreErrors", response.data.data.errors);
            commit("setInfosNewsLetterStoreMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosNewsLetterStoreStatus", "error");
            commit("setInfosNewsLetterStoreMessage", response.data.message);
        }
    },

    async newsLetterUpdateDataRequest({ commit },  payload) {
        const response = await jwtInterceptor.put(`backoffice/admin/${payload.slug}/news_letters_update`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosNewsLetterUpdateStatus", "success");
            commit("setInfosNewsLetterUpdateMessage", response.data.message);
            commit("setInfosNewsLetterUpdateData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosNewsLetterUpdateStatus", "empty");
            commit("setInfosNewsLetterUpdateErrors", response.data.data.errors);
            commit("setInfosNewsLetterUpdateMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosNewsLetterUpdateStatus", "error");
            commit("setInfosNewsLetterUpdateMessage", response.data.message);
        }
    },

    async newsLetterDeleteDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.delete(`backoffice/admin/${payload.slug}/news_letters_delete`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosNewsLetterDeleteStatus", "success");
            commit("setInfosNewsLetterDeleteMessage", response.data.message);
            commit("setInfosNewsLetterDeleteData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosNewsLetterDeleteStatus", "empty");
            commit("setInfosNewsLetterDeleteMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosNewsLetterDeleteStatus", "error");
            commit("setInfosNewsLetterDeleteMessage", response.data.message);
        }
    },

    async newsLetterActivateDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.patch(`backoffice/admin/${payload.slug}/news_letters_activate`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosNewsLetterActivateStatus", "success");
            commit("setInfosNewsLetterActivateMessage", response.data.message);
            commit("setInfosNewsLetterActivateData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosNewsLetterActivateStatus", "empty");
            commit("setInfosNewsLetterActivateMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosNewsLetterActivateStatus", "error");
            commit("setInfosNewsLetterActivateMessage", response.data.message);
        }
    },

    async newsLetterBlockDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.patch(`backoffice/admin/${payload.slug}/news_letters_block`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosNewsLetterBlockStatus", "success");
            commit("setInfosNewsLetterBlockMessage", response.data.message);
            commit("setInfosNewsLetterBlockData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosNewsLetterBlockStatus", "empty");
            commit("setInfosNewsLetterBlockMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosNewsLetterBlockStatus", "error");
            commit("setInfosNewsLetterBlockMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosNewsLetterListStatus(state, value){
        state.infosNewsLetterListStatus = value;
    },

    setInfosNewsLetterListMessage(state, value){
        state.infosNewsLetterListMessage = value;
    },

    setInfosNewsLetterListData(state, value){
        state.infosNewsLetterListData = value;
    },

    setInfosNewsLetterSearchStatus(state, value){
        state.infosNewsLetterSearchStatus = value;
    },

    setInfosNewsLetterSearchMessage(state, value){
        state.infosNewsLetterSearchMessage = value;
    },

    setInfosNewsLetterSearchData(state, value){
        state.infosNewsLetterSearchData = value;
    },

    setInfosNewsLetterShowStatus(state, value){
        state.infosNewsLetterShowStatus = value;
    },

    setInfosNewsLetterShowMessage(state, value){
        state.infosNewsLetterShowMessage = value;
    },

    setInfosNewsLetterShowData(state, value){
        state.infosNewsLetterShowData = value;
    },

    setInfosNewsLetterStoreStatus(state, value){
        state.infosNewsLetterStoreStatus = value;
    },

    setInfosNewsLetterStoreErrors(state, value){
        state.infosNewsLetterStoreErrors = value;
    },

    setInfosNewsLetterStoreMessage(state, value){
        state.infosNewsLetterStoreMessage = value;
    },

    setInfosNewsLetterStoreData(state, value){
        state.infosNewsLetterStoreData = value;
    },

    setInfosNewsLetterUpdateStatus(state, value){
        state.infosNewsLetterUpdateStatus = value;
    },

    setInfosNewsLetterUpdateMessage(state, value){
        state.infosNewsLetterUpdateMessage = value;
    },

    setInfosNewsLetterUpdateErrors(state, value){
        state.infosNewsLetterUpdateErrors = value;
    },

    setInfosNewsLetterUpdateData(state, value){
        state.infosNewsLetterUpdateData = value;
    },
   
    setInfosNewsLetterDeleteStatus(state, value){
        state.infosNewsLetterDeleteStatus = value;
    },

    setInfosNewsLetterDeleteMessage(state, value){
        state.infosNewsLetterDeleteMessage = value;
    },

    setInfosNewsLetterDeleteData(state, value){
        state.infosNewsLetterDeleteData = value;
    },

    setInfosNewsLetterActivateStatus(state, value){
        state.infosNewsLetterActivateStatus = value;
    },

    setInfosNewsLetterActivateMessage(state, value){
        state.infosNewsLetterActivateMessage = value;
    },

    setInfosNewsLetterActivateData(state, value){
        state.infosNewsLetterActivateData = value;
    },

    setInfosNewsLetterBlockStatus(state, value){
        state.infosNewsLetterBlockStatus = value;
    },

    setInfosNewsLetterBlockMessage(state, value){
        state.infosNewsLetterBlockMessage = value;
    },

    setInfosNewsLetterBlockData(state, value){
        state.infosNewsLetterBlockData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
