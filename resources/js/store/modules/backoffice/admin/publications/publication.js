import jwtInterceptor  from '../../../../../shared/jwtInterceptor';
const state = () => ({

    infosPublicationCreateBySlugTypeShowStatus:null,
    infosPublicationCreateBySlugTypeShowMessage:null,
    infosPublicationCreateBySlugTypeShowData:[],
 
});
const getters = {
 
    getInfosPublicationCreateBySlugTypeShowStatus(state){
        return state.infosPublicationCreateBySlugTypeShowStatus;
    },

    getInfosPublicationCreateBySlugTypeShowMessage(state){
        return state.infosPublicationCreateBySlugTypeShowMessage;
    },

    getInfosPublicationCreateBySlugTypeShowData(state){
        return state.infosPublicationCreateBySlugTypeShowData;
    },   
 
}

const actions = {
    
    async publicationCreateBySlugTypeShowDataRequest({ commit }, payload) {
        const response = await jwtInterceptor.get(`backoffice/admin/publications/create/${payload.slug}/type_publications`).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setInfosPublicationCreateBySlugTypeShowStatus", "success");
            commit("setInfosPublicationCreateBySlugTypeShowMessage", response.data.message);
            commit("setInfosPublicationCreateBySlugTypeShowData", response.data.data);
        }else if(response.data.data.status == 401) {
            commit("setInfosPublicationCreateBySlugTypeShowStatus", "empty");
            commit("setInfosPublicationCreateBySlugTypeShowData", response.data.data);
            commit("setInfosPublicationCreateBySlugTypeShowMessage", response.data.message);
        }else if(response.data.data.status == 422){
            commit("setInfosPublicationCreateBySlugTypeShowStatus", "error");
            commit("setInfosPublicationCreateBySlugTypeShowMessage", response.data.message);
        }
    },
 
}

const mutations = {
     

    setInfosPublicationCreateBySlugTypeShowStatus(state, value){
        state.infosPublicationCreateBySlugTypeShowStatus = value;
    },

    setInfosPublicationCreateBySlugTypeShowMessage(state, value){
        state.infosPublicationCreateBySlugTypeShowMessage = value;
    },

    setInfosPublicationCreateBySlugTypeShowData(state, value){
        state.infosPublicationCreateBySlugTypeShowData = value;
    },
 
}

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
