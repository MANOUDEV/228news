import axios from "axios";
const state = () => ({
    sendOtpForgotPasswordStatus:null,
    sendOtpForgotPasswordMessage:null,
    sendOtpForgotPasswordErrors: [],
    checkOtpForgotPasswordStatus:null,
    checkOtpForgotPasswordMessage:null,
    checkOtpForgotPasswordErrors: [],
    newPassOtpForgotPasswordStatus:null,
    newPassOtpForgotPasswordMessage:null,
    newPassOtpForgotPasswordErrors: [],
  });

  const getters = {
    getSendOtpForgotPasswordStatus(state){
        return state.sendOtpForgotPasswordStatus;
    },

    getSendOtpForgotPasswordMessage(state){
        return state.sendOtpForgotPasswordMessage;
    },

    getSendOtpForgotPasswordErrors(state){
        return state.sendOtpForgotPasswordErrors;
    },

    getCheckOtpForgotPasswordStatus(state){
        return state.checkOtpForgotPasswordStatus;
    },

    getCheckOtpForgotPasswordMessage(state){
        return state.checkOtpForgotPasswordMessage;
    },

    getCheckOtpForgotPasswordErrors(state){
        return state.checkOtpForgotPasswordErrors;
    },

    getNewPassOtpForgotPasswordStatus(state){
        return state.newPassOtpForgotPasswordStatus;
    },

    getNewPassOtpForgotPasswordMessage(state){
        return state.newPassOtpForgotPasswordMessage;
    },

    getNewPassOtpForgotPasswordErrors(state){
        return state.newPassOtpForgotPasswordErrors;
    },

  };

  const actions = {
    async sendOtpForgotPassword({ commit }, payload) {
        const response = await axios.post("/api/auth/send_otp/forgot_password", payload).catch((err) => { console.log(err);});
        if (response && (response.data.status == 200)) {
          commit("setSendOtpForgotPasswordStatus", "success");
          commit("setSendOtpForgotPasswordMessage", response.data.message);
        }else if(response.data.status == 422) {
          commit("setSendOtpForgotPasswordStatus", "failed");
          commit("setSendOtpForgotPasswordMessage", response.data.message);
        }else if (response.data.status == 401) {
            commit("setSendOtpForgotPasswordStatus", "error");
            commit("setSendOtpForgotPasswordMessage", response.data.message);
            commit("setSendOtpForgotPasswordErrors", response.data.errors);
        }
    },

    async checkOtpForgotPassword({ commit }, payload) {
        const response = await axios.patch("/api/auth/check_otp/forgot_password", payload).catch((err) => { console.log(err);});
        if (response && (response.data.status == 200)) {
          commit("setCheckOtpForgotPasswordStatus", "success");
          commit("setCheckOtpForgotPasswordMessage", response.data.message);
        }else if(response.data.status == 422) {
          commit("setCheckOtpForgotPasswordStatus", "failed");
          commit("setCheckOtpForgotPasswordMessage", response.data.message);
        }else if (response.data.status == 401) {
            commit("setCheckOtpForgotPasswordStatus", "error");
            commit("setCheckOtpForgotPasswordMessage", response.data.message);
            commit("setCheckOtpForgotPasswordErrors", response.data.errors);
        }
    },

    async newPassOtpForgotPassword({ commit }, payload) {
        const response = await axios.patch("/api/auth/new_pass/forgot_password", payload).catch((err) => { console.log(err);});
        if (response && (response.data.status == 200)) {
          commit("setNewPassOtpForgotPasswordStatus", "success");
          commit("setNewPassOtpForgotPasswordMessage", response.data.message);
        }else if(response.data.status == 422) {
          commit("setNewPassOtpForgotPasswordStatus", "failed");
          commit("setNewPassOtpForgotPasswordMessage", response.data.message);
        }else if (response.data.status == 401) {
            commit("setNewPassOtpForgotPasswordStatus", "error");
            commit("setNewPassOtpForgotPasswordMessage", response.data.message);
            commit("setNewPassOtpForgotPasswordErrors", response.data.errors);
        }
    }
  };

  const mutations = {
    setSendOtpForgotPasswordStatus(state, value){
        state.sendOtpForgotPasswordStatus = value;
    },

    setSendOtpForgotPasswordMessage(state, value){
        state.sendOtpForgotPasswordMessage = value;
    },

    setSendOtpForgotPasswordErrors(state, value){
        state.sendOtpForgotPasswordErrors = value;
    },

    setCheckOtpForgotPasswordStatus(state, value){
        state.checkOtpForgotPasswordStatus = value;
    },

    setCheckOtpForgotPasswordMessage(state, value){
        state.checkOtpForgotPasswordMessage = value;
    },

    setCheckOtpForgotPasswordErrors(state, value){
        state.checkOtpForgotPasswordErrors = value;
    },

    setNewPassOtpForgotPasswordStatus(state, value){
        state.newPassOtpForgotPasswordStatus = value;
    },

    setNewPassOtpForgotPasswordMessage(state, value){
        state.newPassOtpForgotPasswordMessage = value;
    },

    setNewPassOtpForgotPasswordErrors(state, value){
        state.newPassOtpForgotPasswordErrors = value;
    },
  };

  export default{
      namespaced:true,
      state,
      getters,
      actions,
      mutations
  }
