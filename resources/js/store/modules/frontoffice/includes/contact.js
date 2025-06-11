import axios from "axios";
import jwtInterceptor from "../../../../shared/jwtInterceptor";
const state = () => ({
    contactStatus:null,
    contactMessage:null,
    contactErrors: [],
    contactAuthStatus:null,
    contactAuthMessage:null,
    contactAuthErrors: [],
});
const getters = {
    getContactStatus(state){
        return state.contactStatus;
    },

    getContactMessage(state){
        return state.contactMessage;
    },

    getContactErrors(state){
        return state.contactErrors;
    },

    getContactAuthStatus(state){
        return state.contactAuthStatus;
    },

    getContactAuthMessage(state){
        return state.contactAuthMessage;
    },

    getContactAuthErrors(state){
        return state.contactAuthErrors;
    },
}

const actions = {
    async contact({ commit }, payload) {
        const response = await axios.post("/api/home/contact", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setContactStatus", "success");
            commit("setContactMessage", response.data.message);
        }else if(response.data.data.status == 422) {
            commit("setContactStatus", "failed");
            commit("setContactMessage", response.data.message);
        }else if (response.data.data.status == 401) {
            commit("setContactStatus", "error");
            commit("setContactMessage", response.data.message);
            commit("setContactErrors", response.data.data.errors);
        }
    },
    async contactAuth({ commit }, payload) {
        const response = await jwtInterceptor.post("home/contact_auth", payload).catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setContactAuthStatus", "success");
            commit("setContactAuthMessage", response.data.message);
        }else if(response.data.data.status == 422) {
            commit("setContactAuthStatus", "failed");
            commit("setContactAuthMessage", response.data.message);
        }else if (response.data.data.status == 401) {
            commit("setContactAuthStatus", "error");
            commit("setContactAuthMessage", response.data.message);
            commit("setContactAuthErrors", response.data.data.errors);
        }
    }
  };

  const mutations = {
    setContactStatus(state, value){
        state.contactStatus = value;
    },

    setContactMessage(state, value){
        state.contactMessage = value;
    },

    setContactErrors(state, value){
        state.contactErrors = value;
    },

    setContactAuthStatus(state, value){
        state.contactAuthStatus = value;
    },

    setContactAuthMessage(state, value){
        state.contactAuthMessage = value;
    },

    setContactAuthErrors(state, value){
        state.contactAuthErrors = value;
    },
  };

  export default{
      namespaced:true,
      state,
      getters,
      actions,
      mutations
  }
