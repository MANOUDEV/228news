import axios from "axios";
const state = () => ({
    sendOtpRegisterStatus:null,
    sendOtpRegisterMessage:null,
    sendOtpRegisterErrors: [],
    checkOtpRegisterStatus:null,
    checkOtpRegisterMessage:null,
    checkOtpRegisterErrors: [],
    newPassOtpRegisterStatus:null,
    newPassOtpRegisterMessage:null,
    newPassOtpRegisterErrors: [],
    newInfoOtpRegisterStatus:null,
    newInfoOtpRegisterMessage:null,
    newInfoOtpRegisterErrors: [],
    loginStatus:null,
    loginMessage:null,
    roleStatus: null,
  });

  const getters = {
    getSendOtpRegisterStatus(state){
        return state.sendOtpRegisterStatus;
    },

    getSendOtpRegisterMessage(state){
        return state.sendOtpRegisterMessage;
    },

    getSendOtpRegisterErrors(state){
        return state.sendOtpRegisterErrors;
    },

    getCheckOtpRegisterStatus(state){
        return state.checkOtpRegisterStatus;
    },

    getCheckOtpRegisterMessage(state){
        return state.checkOtpRegisterMessage;
    },

    getCheckOtpRegisterErrors(state){
        return state.checkOtpRegisterErrors;
    },

    getNewPassOtpRegisterStatus(state){
        return state.newPassOtpRegisterStatus;
    },

    getNewPassOtpRegisterMessage(state){
        return state.newPassOtpRegisterMessage;
    },

    getNewPassOtpRegisterErrors(state){
        return state.newPassOtpRegisterErrors;
    },

    getNewInfoOtpRegisterStatus(state){
        return state.newInfoOtpRegisterStatus;
    },

    getNewInfoOtpRegisterMessage(state){
        return state.newInfoOtpRegisterMessage;
    },

    getNewInfoOtpRegisterErrors(state){
        return state.newInfoOtpRegisterErrors;
    },

    getLoginStatus(state){
        return state.loginStatus;
    },

    getRoleStatus(state){
        return state.roleStatus;
    },

    getLoginMessage(state){
        return state.loginMessage;
    },

  };

  const actions = {
    async sendOtpRegister({ commit }, payload) {
        const response = await axios.post("/api/auth/send_otp/register", payload).catch((err) => { console.log(err);});
        if (response && (response.data.status == 200)) {
          commit("setSendOtpRegisterStatus", "success");
          commit("setSendOtpRegisterMessage", response.data.message);
        }else if(response.data.status == 422) {
          commit("setSendOtpRegisterStatus", "failed");
          commit("setSendOtpRegisterMessage", response.data.message);
        }else if (response.data.status == 401) {
            commit("setSendOtpRegisterStatus", "error");
            commit("setSendOtpRegisterMessage", response.data.message);
            commit("setSendOtpRegisterErrors", response.data.errors);
        }
    },

    async checkOtpRegister({ commit }, payload) {
        const response = await axios.patch("/api/auth/check_otp/register", payload).catch((err) => { console.log(err);});
        if (response && (response.data.status == 200)) {
          commit("setCheckOtpRegisterStatus", "success");
          commit("setCheckOtpRegisterMessage", response.data.message);
        }else if(response.data.status == 422) {
          commit("setCheckOtpRegisterStatus", "failed");
          commit("setCheckOtpRegisterMessage", response.data.message);
        }else if (response.data.status == 401) {
            commit("setCheckOtpRegisterStatus", "error");
            commit("setCheckOtpRegisterMessage", response.data.message);
            commit("setCheckOtpRegisterErrors", response.data.errors);
        }
    },

    async newInfoOtpRegister ({ commit }, payload) {
        const response = await axios.put("/api/auth/new_info/register", payload).catch((err) => { console.log(err);});
        if (response && (response.data.status == 200)) {
          commit("setNewInfoOtpRegisterStatus", "success");
          commit("setNewInfoOtpRegisterMessage", response.data.message);
        }else if(response.data.status == 422) {
          commit("setNewInfoOtpRegisterStatus", "failed");
          commit("setNewInfoOtpRegisterMessage", response.data.message);
        }else if (response.data.status == 401) {
            commit("setNewInfoOtpRegisterStatus", "error");
            commit("setNewInfoOtpRegisterMessage", response.data.message);
            commit("setNewInfoOtpRegisterErrors", response.data.errors);
        }
    },

    async newPassOtpRegister({ commit }, payload) {
        const response = await axios.patch("/api/auth/new_pass/register", payload).catch((err) => { console.log(err);});
        if (response && (response.data.status == 200)) {
          commit("setNewPassOtpRegisterStatus", "success");
          commit("setNewPassOtpRegisterMessage", response.data.message);
          commit("saveTokenData", response.data);
          commit("setLoginStatus", "success visitor");
          commit("setRoleStatus", "&nbdfpo@!");
          commit("setLoginMessage", response.data.message);
        }else if(response.data.status == 422) {
          commit("setNewPassOtpRegisterStatus", "failed");
          commit("setNewPassOtpRegisterMessage", response.data.message);
        }else if (response.data.status == 401) {
            commit("setNewPassOtpRegisterStatus", "error");
            commit("setNewPassOtpRegisterMessage", response.data.message);
            commit("setNewPassOtpRegisterErrors", response.data.errors);
        }
    }
  };

  const mutations = {
    setSendOtpRegisterStatus(state, value){
        state.sendOtpRegisterStatus = value;
    },

    setSendOtpRegisterMessage(state, value){
        state.sendOtpRegisterMessage = value;
    },

    setSendOtpRegisterErrors(state, value){
        state.sendOtpRegisterErrors = value;
    },

    setCheckOtpRegisterStatus(state, value){
        state.checkOtpRegisterStatus = value;
    },

    setCheckOtpRegisterMessage(state, value){
        state.checkOtpRegisterMessage = value;
    },

    setCheckOtpRegisterErrors(state, value){
        state.checkOtpRegisterErrors = value;
    },

    setNewPassOtpRegisterStatus(state, value){
        state.newPassOtpRegisterStatus = value;
    },

    setNewPassOtpRegisterMessage(state, value){
        state.newPassOtpRegisterMessage = value;
    },

    setNewPassOtpRegisterErrors(state, value){
        state.newPassOtpRegisterErrors = value;
    },

    setNewInfoOtpRegisterStatus(state, value){
        state.newInfoOtpRegisterStatus = value;
    },

    setNewInfoOtpRegisterMessage(state, value){
        state.newInfoOtpRegisterMessage = value;
    },

    setNewInfoOtpRegisterErrors(state, value){
        state.newInfoOtpRegisterErrors = value;
    },

    saveTokenData(state, data) {
    
        localStorage.setItem("access_token", data.access_token.original.access_token);

        localStorage.setItem("expires_in", parseInt(data.access_token.original.expires_in));
    
        const newTokenData = {
            access_token: localStorage.getItem('access_token'),
            expires_in: localStorage.getItem('expires_in'),
           
        };
        state.authData = {
            access_token: localStorage.getItem('access_token'),
            expires_in: localStorage.getItem('expires_in'),
        }; 
    },
    setLoginStatus(state, value){
        state.loginStatus = value;
    },

    setRoleStatus(state, value){
        localStorage.setItem("nbRsp", value);
        state.roleStatus = value;
    },

    setLoginMessage(state, value){
        state.loginMessage = value;
    },
  };

  export default{
      namespaced:true,
      state,
      getters,
      actions,
      mutations
  }
