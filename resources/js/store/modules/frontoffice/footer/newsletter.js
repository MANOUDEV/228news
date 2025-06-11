import axios from "axios";
const state = () => ({
    newsletterStatus:null,
    newsletterMessage:null,
    newsletterErrors: [],
});

const getters = {
    getNewsletterStatus(state){
        return state.newsletterStatus;
    },

    getNewsletterMessage(state){
        return state.newsletterMessage;
    },

    getNewsletterErrors(state){
        return state.newsletterErrors;
    },
}

const actions = {
    async newsletterRequest({ commit }, payload) {
        const response = await axios.post("/api/frontoffice/footer/newsletter", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setNewsletterStatus", "success");
            commit("setNewsletterMessage", response.data.message);
        }else if(response.data.data.status == 422) {
            commit("setNewsletterStatus", "failed");
            commit("setNewsletterMessage", response.data.message);
        }else if (response.data.data.status == 401) {
            commit("setNewsletterStatus", "error");
            commit("setNewsletterMessage", response.data.message);
            commit("setNewsletterErrors", response.data.data.errors);
        }
    },
}

const mutations = {
    setNewsletterStatus(state, value){
        state.newsletterStatus = value;
    },

    setNewsletterMessage(state, value){
        state.newsletterMessage = value;
    },

    setNewsletterErrors(state, value){
        state.newsletterErrors = value;
    },

};

export default{
    namespaced:true,
    state,
    getters,
    actions,
    mutations
}
