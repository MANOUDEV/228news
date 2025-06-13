import jwtInterceptor  from '../../../../shared/jwtInterceptor';
const state = () => ({
    infosCategoryListStatus:null,
    infosCategoryListMessage:null,
    infosCategoryListData:[],

    infosCategoryShowStatus:null,
    infosCategoryShowMessage:null,
    infosCategoryShowData:[],

    infosCategoryStoreStatus:null,
    infosCategoryStoreMessage:null,
    infosCategoryStoreData:[],
    infosCategoryStoreErrors:[],

    infosCategoryUpdateStatus:null,
    infosCategoryUpdateMessage:null,
    infosCategoryUpdateData:[],
    infosCategoryUpdateErrors:[],

    infosCategoryDeleteStatus:null,
    infosCategoryDeleteMessage:null,
    infosCategoryDeleteData:[],
});
const getters = {

    getInfosCategoryListStatus(state){
        return state.infosCategoryListStatus;
    },

    getInfosCategoryListMessage(state){
        return state.infosCategoryListMessage;
    },

    getInfosCategoryListData(state){
        return state.infosCategoryListData;
    },

    getInfosCategoryShowStatus(state){
        return state.infosCategoryShowStatus;
    },

    getInfosCategoryShowMessage(state){
        return state.infosCategoryShowMessage;
    },

    getInfosCategoryShowData(state){
        return state.infosCategoryShowData;
    },

    getInfosCategoryStoreStatus(state){
        return state.infosCategoryStoreStatus;
    },

    getInfosCategoryStoreMessage(state){
        return state.infosCategoryStoreMessage;
    },

    getInfosCategoryStoreErrors(state){
        return state.infosCategoryStoreErrors;
    },

    getInfosCategoryStoreData(state){
        return state.infosCategoryStoreData;
    },

    getInfosCategoryUpdateStatus(state){
        return state.infosCategoryUpdateStatus;
    },

    getInfosCategoryUpdateMessage(state){
        return state.infosCategoryUpdateMessage;
    },

    getInfosCategoryUpdateErrors(state){
        return state.infosCategoryUpdateErrors;
    },

    getInfosCategoryUpdateData(state){
        return state.infosCategoryUpdateData;
    },

    getInfosCategoryDeleteStatus(state){
        return state.infosCategoryDeleteStatus;
    },

    getInfosCategoryDeleteMessage(state){
        return state.infosCategoryDeleteMessage;
    },

    getInfosCategoryDeleteData(state){
        return state.infosCategoryDeleteData;
    },
   
}

const actions = {
    async categoryListDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/admin/category_list?page=${payload.page}&search=${payload.search}`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCategoryListStatus", "success");
            commit("setInfosCategoryListMessage", response.data.message);
            commit("setInfosCategoryListData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosCategoryListStatus", "empty");
            commit("setInfosCategoryListData", response.data.data);
            commit("setInfosCategoryListMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCategoryListStatus", "error");
            commit("setInfosCategoryListMessage", response.data.message);
        }
    },

    async categoryShowDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get("backoffice/admin/category_show", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCategoryShowStatus", "success");
            commit("setInfosCategoryShowMessage", response.data.message);
            commit("setInfosCategoryShowData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosCategoryShowStatus", "empty");
            commit("setInfosCategoryListData", response.data.data);
            commit("setInfosCategoryShowMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCategoryShowStatus", "error");
            commit("setInfosCategoryShowMessage", response.data.message);
        }
    },

    async categoryStoreDataRequest({ commit },  payload) {
        const response = await jwtInterceptor.post("backoffice/admin/category_store", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCategoryStoreStatus", "success");
            commit("setInfosCategoryStoreMessage", response.data.message);
            commit("setInfosCategoryStoreData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosCategoryStoreStatus", "empty");
            commit("setInfosCategoryStoreErrors", response.data.data.errors);
            commit("setInfosCategoryStoreMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCategoryStoreStatus", "error");
            commit("setInfosCategoryStoreMessage", response.data.message);
        }
    },

    async categoryUpdateDataRequest({ commit },  payload) {
        const response = await jwtInterceptor.put(`backoffice/admin/${payload.slug}/category_update`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCategoryUpdateStatus", "success");
            commit("setInfosCategoryUpdateMessage", response.data.message);
            commit("setInfosCategoryUpdateData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosCategoryUpdateStatus", "empty");
            commit("setInfosCategoryUpdateErrors", response.data.data.errors);
            commit("setInfosCategoryUpdateMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCategoryUpdateStatus", "error");
            commit("setInfosCategoryUpdateMessage", response.data.message);
        }
    },

    async categoryDeleteDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.delete(`backoffice/admin/${payload.slug}/category_delete`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosCategoryDeleteStatus", "success");
            commit("setInfosCategoryDeleteMessage", response.data.message);
            commit("setInfosCategoryDeleteData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosCategoryDeleteStatus", "empty");
            commit("setInfosCategoryDeleteMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosCategoryDeleteStatus", "error");
            commit("setInfosCategoryDeleteMessage", response.data.message);
        }
    },

}

const mutations = {
    setInfosCategoryListStatus(state, value){
        state.infosCategoryListStatus = value;
    },

    setInfosCategoryListMessage(state, value){
        state.infosCategoryListMessage = value;
    },

    setInfosCategoryListData(state, value){
        state.infosCategoryListData = value;
    },

    setInfosCategoryShowStatus(state, value){
        state.infosCategoryShowStatus = value;
    },

    setInfosCategoryShowMessage(state, value){
        state.infosCategoryShowMessage = value;
    },

    setInfosCategoryShowData(state, value){
        state.infosCategoryShowData = value;
    },

    setInfosCategoryStoreStatus(state, value){
        state.infosCategoryStoreStatus = value;
    },

    setInfosCategoryStoreErrors(state, value){
        state.infosCategoryStoreErrors = value;
    },

    setInfosCategoryStoreMessage(state, value){
        state.infosCategoryStoreMessage = value;
    },

    setInfosCategoryStoreData(state, value){
        state.infosCategoryStoreData = value;
    },

    setInfosCategoryUpdateStatus(state, value){
        state.infosCategoryUpdateStatus = value;
    },

    setInfosCategoryUpdateMessage(state, value){
        state.infosCategoryUpdateMessage = value;
    },

    setInfosCategoryUpdateErrors(state, value){
        state.infosCategoryUpdateErrors = value;
    },

    setInfosCategoryUpdateData(state, value){
        state.infosCategoryUpdateData = value;
    },
   
    setInfosCategoryDeleteStatus(state, value){
        state.infosCategoryDeleteStatus = value;
    },

    setInfosCategoryDeleteMessage(state, value){
        state.infosCategoryDeleteMessage = value;
    },

    setInfosCategoryDeleteData(state, value){
        state.infosCategoryDeleteData = value;
    },
   
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
