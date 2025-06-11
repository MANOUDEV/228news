import jwtInterceptor  from '../../../shared/jwtInterceptor';
 
const state = () => ({
  meRoleName: "",
  roleStatus:"",
});
 
const getters = {
  
  getMeRoleName(state){
    return state.meRoleName;
   },
  getRoleStatus(state){
    return state.roleStatus;
  },
};
 
const actions = {
    async getMeRole({commit}){
        var response = await jwtInterceptor.get('role').catch((err) =>{
          if(err.response.status == 401){
            commit("setRoleStatus", "failed");
          }
        });
        if(response && response.data.status == 200){
            commit("setRoleStatus", "success");
            commit('setMeRoleName', response.data.role);
        }else{
          commit("setRoleStatus", "failed");
        }
    }
};
 
const mutations = {
 
  setMeRoleName(state, value){
    state.meRoleName = value;
   },

  setRoleStatus(state, value){
    state.roleStatus = value;
  },

 
};
 
export default{
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}