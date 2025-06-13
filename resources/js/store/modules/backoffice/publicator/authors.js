import jwtInterceptor  from '../../../../shared/jwtInterceptor';
const state = () => ({
    infosAuthorsListStatus:null,
    infosAuthorsListMessage:null,
    infosAuthorsListData:[],

    infosAuthorsShowStatus:null,
    infosAuthorsShowMessage:null,
    infosAuthorsShowData:[],

    infosAuthorsStoreStatus:null,
    infosAuthorsStoreMessage:null,
    infosAuthorsStoreData:[],
    infosAuthorsStoreErrors:[],

    infosAuthorsUpdateStatus:null,
    infosAuthorsUpdateMessage:null,
    infosAuthorsUpdateData:[],
    infosAuthorsUpdateErrors:[],

    infosAuthorsDeleteStatus:null,
    infosAuthorsDeleteMessage:null,
    infosAuthorsDeleteData:[],
});
const getters = {

    getInfosAuthorsListStatus(state){
        return state.infosAuthorsListStatus;
    },

    getInfosAuthorsListMessage(state){
        return state.infosAuthorsListMessage;
    },

    getInfosAuthorsListData(state){
        return state.infosAuthorsListData;
    },

    getInfosAuthorsShowStatus(state){
        return state.infosAuthorsShowStatus;
    },

    getInfosAuthorsShowMessage(state){
        return state.infosAuthorsShowMessage;
    },

    getInfosAuthorsShowData(state){
        return state.infosAuthorsShowData;
    },

    getInfosAuthorsStoreStatus(state){
        return state.infosAuthorsStoreStatus;
    },

    getInfosAuthorsStoreMessage(state){
        return state.infosAuthorsStoreMessage;
    },

    getInfosAuthorsStoreErrors(state){
        return state.infosAuthorsStoreErrors;
    },

    getInfosAuthorsStoreData(state){
        return state.infosAuthorsStoreData;
    },

    getInfosAuthorsUpdateStatus(state){
        return state.infosAuthorsUpdateStatus;
    },

    getInfosAuthorsUpdateMessage(state){
        return state.infosAuthorsUpdateMessage;
    },

    getInfosAuthorsUpdateErrors(state){
        return state.infosAuthorsUpdateErrors;
    },

    getInfosAuthorsUpdateData(state){
        return state.infosAuthorsUpdateData;
    },

    getInfosAuthorsDeleteStatus(state){
        return state.infosAuthorsDeleteStatus;
    },

    getInfosAuthorsDeleteMessage(state){
        return state.infosAuthorsDeleteMessage;
    },

    getInfosAuthorsDeleteData(state){
        return state.infosAuthorsDeleteData;
    },
   
}

const actions = {
    async authorsListDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/publicator/authors_list?page=${payload.page}&search=${payload.search}`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosAuthorsListStatus", "success");
            commit("setInfosAuthorsListMessage", response.data.message);
            commit("setInfosAuthorsListData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosAuthorsListStatus", "empty");
            commit("setInfosAuthorsListData", response.data.data);
            commit("setInfosAuthorsListMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosAuthorsListStatus", "error");
            commit("setInfosAuthorsListMessage", response.data.message);
        }
    },

    async authorsShowDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/publicator/${payload.slug}/authors_show`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosAuthorsShowStatus", "success");
            commit("setInfosAuthorsShowMessage", response.data.message);
            commit("setInfosAuthorsShowData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosAuthorsShowStatus", "empty");
            commit("setInfosAuthorsListData", response.data.data);
            commit("setInfosAuthorsShowMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosAuthorsShowStatus", "error");
            commit("setInfosAuthorsShowMessage", response.data.message);
        }
    },

    async authorsStoreDataRequest({ commit },  payload) {
        const response = await jwtInterceptor.post("backoffice/publicator/authors_store", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosAuthorsStoreStatus", "success");
            commit("setInfosAuthorsStoreMessage", response.data.message);
            commit("setInfosAuthorsStoreData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosAuthorsStoreStatus", "empty");
            commit("setInfosAuthorsStoreErrors", response.data.data.errors);
            commit("setInfosAuthorsStoreMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosAuthorsStoreStatus", "error");
            commit("setInfosAuthorsStoreMessage", response.data.message);
        }
    },

    async authorsUpdateDataRequest({ commit },  payload) {
        const response = await jwtInterceptor.put(`backoffice/publicator/${payload.slug}/authors_update`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosAuthorsUpdateStatus", "success");
            commit("setInfosAuthorsUpdateMessage", response.data.message);
            commit("setInfosAuthorsUpdateData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosAuthorsUpdateStatus", "empty");
            commit("setInfosAuthorsUpdateErrors", response.data.data.errors);
            commit("setInfosAuthorsUpdateMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosAuthorsUpdateStatus", "error");
            commit("setInfosAuthorsUpdateMessage", response.data.message);
        }
    },

    async authorsDeleteDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.delete(`backoffice/publicator/${payload.slug}/authors_delete`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosAuthorsDeleteStatus", "success");
            commit("setInfosAuthorsDeleteMessage", response.data.message);
            commit("setInfosAuthorsDeleteData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosAuthorsDeleteStatus", "empty");
            commit("setInfosAuthorsDeleteMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosAuthorsDeleteStatus", "error");
            commit("setInfosAuthorsDeleteMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosAuthorsListStatus(state, value){
        state.infosAuthorsListStatus = value;
    },

    setInfosAuthorsListMessage(state, value){
        state.infosAuthorsListMessage = value;
    },

    setInfosAuthorsListData(state, value){
        state.infosAuthorsListData = value;
    },

    setInfosAuthorsShowStatus(state, value){
        state.infosAuthorsShowStatus = value;
    },

    setInfosAuthorsShowMessage(state, value){
        state.infosAuthorsShowMessage = value;
    },

    setInfosAuthorsShowData(state, value){
        state.infosAuthorsShowData = value;
    },

    setInfosAuthorsStoreStatus(state, value){
        state.infosAuthorsStoreStatus = value;
    },

    setInfosAuthorsStoreErrors(state, value){
        state.infosAuthorsStoreErrors = value;
    },

    setInfosAuthorsStoreMessage(state, value){
        state.infosAuthorsStoreMessage = value;
    },

    setInfosAuthorsStoreData(state, value){
        state.infosAuthorsStoreData = value;
    },

    setInfosAuthorsUpdateStatus(state, value){
        state.infosAuthorsUpdateStatus = value;
    },

    setInfosAuthorsUpdateMessage(state, value){
        state.infosAuthorsUpdateMessage = value;
    },

    setInfosAuthorsUpdateErrors(state, value){
        state.infosAuthorsUpdateErrors = value;
    },

    setInfosAuthorsUpdateData(state, value){
        state.infosAuthorsUpdateData = value;
    },
   
    setInfosAuthorsDeleteStatus(state, value){
        state.infosAuthorsDeleteStatus = value;
    },

    setInfosAuthorsDeleteMessage(state, value){
        state.infosAuthorsDeleteMessage = value;
    },

    setInfosAuthorsDeleteData(state, value){
        state.infosAuthorsDeleteData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
