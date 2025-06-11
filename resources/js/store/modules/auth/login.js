import axios from "axios";
const state = () => ({
    authData: {
      access_token: null,
      expires_in: false,
    },
    loginStatus:null,
    loginMessage:null,
    loginErrors: [],
    roleStatus: null,
  });
   
  const getters = {
    getLoginStatus(state){
        return state.loginStatus;
    },

    getRoleStatus(state){
        return state.roleStatus;
    },

    getLoginMessage(state){
        return state.loginMessage;
    },

    getLoginErrors(state){
        return state.loginErrors;
    },

    getAuthData(state){
        return state.authData;
    },

  };
   
  const actions = {
    async login({ commit }, payload) {
        const response = await axios.post("/api/auth/login", payload).catch((err) => { console.log(err);});
        if (response && (response.data.status == 200) && (response.data.user.name == "Administrateur")) {
          commit("saveTokenData", response.data);
          commit("setLoginStatus", "success admin");
          commit("setRoleStatus", "&nbtsd!?");
          commit("setLoginMessage", response.data.message);
        }else  if (response && (response.data.status == 200) && (response.data.user.name == "Publicateur d' articles")) {
            commit("saveTokenData", response.data);
            commit("setLoginStatus", "success pub");
            commit("setRoleStatus", "&nbrsp?!");
            commit("setLoginMessage", response.data.message);
        }else  if (response && (response.data.status == 200) && (response.data.user.name == "Visiteur")) {
            commit("saveTokenData", response.data);
            commit("setLoginStatus", "success visitor");
            commit("setRoleStatus", "&nbdfpo@!");
            commit("setLoginMessage", response.data.message);
        }else if(response.data.status == 422) {
          commit("setLoginStatus", "failed");
          commit("setLoginMessage", response.data.message);
        }else if (response.data.status == 401) {
            commit("setLoginStatus", "error");
            commit("setLoginMessage", response.data.message);
            commit("setLoginErrors", response.data.errors);
        }
    }
  };
   
  const mutations = {
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

    setLoginErrors(state, value){
        state.loginErrors = value;
    },
  };
   
  export default{
      namespaced:true,
      state,
      getters,
      actions,
      mutations
  }