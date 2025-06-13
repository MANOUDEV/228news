import jwtInterceptor  from '../../../../../../shared/jwtInterceptor';
import axios from "axios";
const state = () => ({ 

    infosPublicationStoreArticlesStatus:null,
    infosPublicationStoreArticlesMessage:null,
    infosPublicationStoreArticlesData:[],
    infosPublicationStoreArticlesErrors:[],

    infosPublicationGetFilesStatus:null,
    infosPublicationGetFilesMessage:null,
    infosPublicationGetFilesData:[],
    infosPublicationGetFilesErrors:[],

    infosPublicationSearchByTypeFilesStatus:null,
    infosPublicationSearchByTypeFilesMessage:null,
    infosPublicationSearchByTypeFilesData:[],
    infosPublicationSearchByTypeFilesErrors:[],
 
});
const getters = { 

    getInfosPublicationStoreArticlesStatus(state){
        return state.infosPublicationStoreArticlesStatus;
    },

    getInfosPublicationStoreArticlesMessage(state){
        return state.infosPublicationStoreArticlesMessage;
    },

    getInfosPublicationStoreArticlesData(state){
        return state.infosPublicationStoreArticlesData;
    },  
    
    getInfosPublicationStoreArticlesErrors(state){
        return state.infosPublicationStoreArticlesErrors;
    },  


    getInfosPublicationGetFilesStatus(state){
        return state.infosPublicationGetFilesStatus;
    },

    getInfosPublicationGetFilesMessage(state){
        return state.infosPublicationGetFilesMessage;
    },

    getInfosPublicationGetFilesData(state){
        return state.infosPublicationGetFilesData;
    },  
    
    getInfosPublicationGetFilesErrors(state){
        return state.infosPublicationGetFilesErrors;
    },
    
    getInfosPublicationSearchByTypeFilesStatus(state){
        return state.infosPublicationSearchByTypeFilesStatus;
    },

    getInfosPublicationSearchByTypeFilesMessage(state){
        return state.infosPublicationSearchByTypeFilesMessage;
    },

    getInfosPublicationSearchByTypeFilesData(state){
        return state.infosPublicationSearchByTypeFilesData;
    },  
    
    getInfosPublicationSearchByTypeFilesErrors(state){
        return state.infosPublicationSearchByTypeFilesErrors;
    },  

     
}

const actions = { 
    
    async publicationStoreArticlesDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.post(`backoffice/admin/publications/create/${payload.slug}/store_articles`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosPublicationStoreArticlesStatus", "success");
            commit("setInfosPublicationStoreArticlesMessage", response.data.message);
            commit("setInfosPublicationStoreArticlesData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosPublicationStoreArticlesStatus", "empty");
            commit("setInfosPublicationStoreArticlesErrors", response.data.data.errors);
            commit("setInfosPublicationStoreArticlesMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosPublicationStoreArticlesStatus", "error");
            commit("setInfosPublicationStoreArticlesMessage", response.data.message);
        }
    },

    async publicationGetFilesDataRequest({ commit }, payload) {
        const response = await axios.get(`/api/auth/backoffice/admin/publications/create/${payload.slug}/get_files?page=${payload.page}&search=${payload.search}`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosPublicationGetFilesStatus", "success");
            commit("setInfosPublicationGetFilesMessage", response.data.message);
            commit("setInfosPublicationGetFilesData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosPublicationGetFilesStatus", "empty");
            commit("setInfosPublicationGetFilesErrors", response.data.data.errors);
            commit("setInfosPublicationGetFilesMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosPublicationGetFilesStatus", "error");
            commit("setInfosPublicationGetFilesMessage", response.data.message);
        }
    },

    async publicationSearchByTypeFilesDataRequest({ commit }, payload) {
        const response = await axios.get(`/api/auth/backoffice/admin/publications/create/${payload.slug}/get_files_search/${payload.status}/search_by_type_files?page=${payload.page}&search=${payload.search}`, payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosPublicationSearchByTypeFilesStatus", "success");
            commit("setInfosPublicationSearchByTypeFilesMessage", response.data.message);
            commit("setInfosPublicationSearchByTypeFilesData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosPublicationSearchByTypeFilesStatus", "empty");
            commit("setInfosPublicationSearchByTypeFilesErrors", response.data.data.errors);
            commit("setInfosPublicationSearchByTypeFilesMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosPublicationSearchByTypeFilesStatus", "error");
            commit("setInfosPublicationSearchByTypeFilesMessage", response.data.message);
        }
    },

    
}

const mutations = { 

    setInfosPublicationStoreArticlesStatus(state, value){
        state.infosPublicationStoreArticlesStatus = value;
    },

    setInfosPublicationStoreArticlesMessage(state, value){
        state.infosPublicationStoreArticlesMessage = value;
    },

    setInfosPublicationStoreArticlesData(state, value){
        state.infosPublicationStoreArticlesData = value;
    },

    setInfosPublicationStoreArticlesErrors(state, value){
        state.infosPublicationStoreArticlesErrors = value;
    },

    setInfosPublicationGetFilesStatus(state, value){
        state.infosPublicationGetFilesStatus = value;
    },

    setInfosPublicationGetFilesMessage(state, value){
        state.infosPublicationGetFilesMessage = value;
    },

    setInfosPublicationGetFilesData(state, value){
        state.infosPublicationGetFilesData = value;
    },

    setInfosPublicationGetFilesErrors(state, value){
        state.infosPublicationGetFilesErrors = value;
    },

    setInfosPublicationSearchByTypeFilesStatus(state, value){
        state.infosPublicationSearchByTypeFilesStatus = value;
    },

    setInfosPublicationSearchByTypeFilesMessage(state, value){
        state.infosPublicationSearchByTypeFilesMessage = value;
    },

    setInfosPublicationSearchByTypeFilesData(state, value){
        state.infosPublicationSearchByTypeFilesData = value;
    },

    setInfosPublicationSearchByTypeFilesErrors(state, value){
        state.infosPublicationSearchByTypeFilesErrors = value;
    },
 
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
