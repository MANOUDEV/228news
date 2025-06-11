import jwtInterceptor  from '../../../shared/jwtInterceptor';
 
const state = () => ({
  logoutStatus:"",
  logoutMessage:"",
  logout: false,
});
 
const getters = {

    getLogoutStatus(state){
        return state.logoutStatus;
    },

    getLogout(state){
        return state.logoutStatus;
    },

    getLogoutMessage(state){
        return state.logoutMessage;
    },
};
 
const actions = {
    async getLogoutApi({commit}){
        var response = await jwtInterceptor.post('logout');
        if(response && response.data.status == 200){
            localStorage.removeItem('access_token')
            localStorage.removeItem('expires_in')
            localStorage.removeItem('nbRsp')
            commit("setLogout", true);
            commit("setLogoutStatus", "success");
            commit("setLogoutMessage", response.data.message);
        }
    }
};
 
const mutations = {

    setLogoutStatus(state, value){
        state.logoutStatus = value;
    },

    setLogout(state, value){
        state.logout = value;
    },

    setLogoutMessage(state, value){
        state.logoutMessage = value;
    },
};
 
export default{
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}