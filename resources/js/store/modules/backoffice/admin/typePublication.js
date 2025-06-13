import jwtInterceptor  from '../../../../shared/jwtInterceptor';
const state = () => ({
    infosTypePublicationListStatus:null,
    infosTypePublicationListMessage:null,
    infosTypePublicationListData:[],

    infosTypePublicationShowStatus:null,
    infosTypePublicationShowMessage:null,
    infosTypePublicationShowData:[],

    infosTypePublicationStoreStatus:null,
    infosTypePublicationStoreMessage:null,
    infosTypePublicationStoreData:[],
    infosTypePublicationStoreErrors:[],

    infosTypePublicationUpdateStatus:null,
    infosTypePublicationUpdateMessage:null,
    infosTypePublicationUpdateData:[],
    infosTypePublicationUpdateErrors:[],

    infosTypePublicationDeleteStatus:null,
    infosTypePublicationDeleteMessage:null,
    infosTypePublicationDeleteData:[],
});
const getters = {

    getInfosTypePublicationListStatus(state){
        return state.infosTypePublicationListStatus;
    },

    getInfosTypePublicationListMessage(state){
        return state.infosTypePublicationListMessage;
    },

    getInfosTypePublicationListData(state){
        return state.infosTypePublicationListData;
    },

    getInfosTypePublicationShowStatus(state){
        return state.infosTypePublicationShowStatus;
    },

    getInfosTypePublicationShowMessage(state){
        return state.infosTypePublicationShowMessage;
    },

    getInfosTypePublicationShowData(state){
        return state.infosTypePublicationShowData;
    },

    getInfosTypePublicationStoreStatus(state){
        return state.infosTypePublicationStoreStatus;
    },

    getInfosTypePublicationStoreMessage(state){
        return state.infosTypePublicationStoreMessage;
    },

    getInfosTypePublicationStoreErrors(state){
        return state.infosTypePublicationStoreErrors;
    },

    getInfosTypePublicationStoreData(state){
        return state.infosTypePublicationStoreData;
    },

    getInfosTypePublicationUpdateStatus(state){
        return state.infosTypePublicationUpdateStatus;
    },

    getInfosTypePublicationUpdateMessage(state){
        return state.infosTypePublicationUpdateMessage;
    },

    getInfosTypePublicationUpdateErrors(state){
        return state.infosTypePublicationUpdateErrors;
    },

    getInfosTypePublicationUpdateData(state){
        return state.infosTypePublicationUpdateData;
    },

    getInfosTypePublicationDeleteStatus(state){
        return state.infosTypePublicationDeleteStatus;
    },

    getInfosTypePublicationDeleteMessage(state){
        return state.infosTypePublicationDeleteMessage;
    },

    getInfosTypePublicationDeleteData(state){
        return state.infosTypePublicationDeleteData;
    },
   
}

const actions = {
    async typePublicationListDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/admin/type_publication_list?page=${payload.page}&search=${payload.search}`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTypePublicationListStatus", "success");
            commit("setInfosTypePublicationListMessage", response.data.message);
            commit("setInfosTypePublicationListData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTypePublicationListStatus", "empty");
            commit("setInfosTypePublicationListData", response.data.data);
            commit("setInfosTypePublicationListMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTypePublicationListStatus", "error");
            commit("setInfosTypePublicationListMessage", response.data.message);
        }
    },

    async typePublicationShowDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get("backoffice/admin/type_publication_show", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTypePublicationShowStatus", "success");
            commit("setInfosTypePublicationShowMessage", response.data.message);
            commit("setInfosTypePublicationShowData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTypePublicationShowStatus", "empty");
            commit("setInfosTypePublicationListData", response.data.data);
            commit("setInfosTypePublicationShowMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTypePublicationShowStatus", "error");
            commit("setInfosTypePublicationShowMessage", response.data.message);
        }
    },

    async typePublicationStoreDataRequest({ commit },  payload) {
        const response = await jwtInterceptor.post("backoffice/admin/type_publication_store", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTypePublicationStoreStatus", "success");
            commit("setInfosTypePublicationStoreMessage", response.data.message);
            commit("setInfosTypePublicationStoreData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTypePublicationStoreStatus", "empty");
            commit("setInfosTypePublicationStoreErrors", response.data.data.errors);
            commit("setInfosTypePublicationStoreMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTypePublicationStoreStatus", "error");
            commit("setInfosTypePublicationStoreMessage", response.data.message);
        }
    },

    async typePublicationUpdateDataRequest({ commit },  payload) {
        const response = await jwtInterceptor.put(`backoffice/admin/${payload.slug}/type_publication_update`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTypePublicationUpdateStatus", "success");
            commit("setInfosTypePublicationUpdateMessage", response.data.message);
            commit("setInfosTypePublicationUpdateData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTypePublicationUpdateStatus", "empty");
            commit("setInfosTypePublicationUpdateErrors", response.data.data.errors);
            commit("setInfosTypePublicationUpdateMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTypePublicationUpdateStatus", "error");
            commit("setInfosTypePublicationUpdateMessage", response.data.message);
        }
    },

    async typePublicationDeleteDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.delete(`backoffice/admin/${payload.slug}/type_publication_delete`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosTypePublicationDeleteStatus", "success");
            commit("setInfosTypePublicationDeleteMessage", response.data.message);
            commit("setInfosTypePublicationDeleteData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosTypePublicationDeleteStatus", "empty");
            commit("setInfosTypePublicationDeleteMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosTypePublicationDeleteStatus", "error");
            commit("setInfosTypePublicationDeleteMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosTypePublicationListStatus(state, value){
        state.infosTypePublicationListStatus = value;
    },

    setInfosTypePublicationListMessage(state, value){
        state.infosTypePublicationListMessage = value;
    },

    setInfosTypePublicationListData(state, value){
        state.infosTypePublicationListData = value;
    },

    setInfosTypePublicationShowStatus(state, value){
        state.infosTypePublicationShowStatus = value;
    },

    setInfosTypePublicationShowMessage(state, value){
        state.infosTypePublicationShowMessage = value;
    },

    setInfosTypePublicationShowData(state, value){
        state.infosTypePublicationShowData = value;
    },

    setInfosTypePublicationStoreStatus(state, value){
        state.infosTypePublicationStoreStatus = value;
    },

    setInfosTypePublicationStoreErrors(state, value){
        state.infosTypePublicationStoreErrors = value;
    },

    setInfosTypePublicationStoreMessage(state, value){
        state.infosTypePublicationStoreMessage = value;
    },

    setInfosTypePublicationStoreData(state, value){
        state.infosTypePublicationStoreData = value;
    },

    setInfosTypePublicationUpdateStatus(state, value){
        state.infosTypePublicationUpdateStatus = value;
    },

    setInfosTypePublicationUpdateMessage(state, value){
        state.infosTypePublicationUpdateMessage = value;
    },

    setInfosTypePublicationUpdateErrors(state, value){
        state.infosTypePublicationUpdateErrors = value;
    },

    setInfosTypePublicationUpdateData(state, value){
        state.infosTypePublicationUpdateData = value;
    },
   
    setInfosTypePublicationDeleteStatus(state, value){
        state.infosTypePublicationDeleteStatus = value;
    },

    setInfosTypePublicationDeleteMessage(state, value){
        state.infosTypePublicationDeleteMessage = value;
    },

    setInfosTypePublicationDeleteData(state, value){
        state.infosTypePublicationDeleteData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
