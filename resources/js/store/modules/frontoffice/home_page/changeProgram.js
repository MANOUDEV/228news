import axios from "axios";
 
const state = () => ({
    changeStatus:"",
    changeMessage:"", 
});
const getters = {
    getChangeStatus(state){
        return state.changeStatus;
    },

    getChangeMessage(state){
        return state.changeMessage;
    },

      
}

const actions = {
    async change({ commit }, payload) {
        const response = await axios.get("/api/auth/backoffice/admin/publications/change_programm").catch((err) => { console.log(err);});
        if (response && (response.data.data.status == 200)) {
            commit("setChangeStatu", "success");
            commit("setChangeMessage", response.data.message);
        }else if(response.data.data.status == 422) {
            commit("setChangeStatu", "failed");
            commit("setChangeMessage", response.data.message);
        }else if (response.data.data.status == 401) {
            commit("setChangeStatu", "error");
            commit("setChangeMessage", response.data.message);
            
        }
    },

  };

  const mutations = {
    setChangeStatu(state, value){
        state.changeStatus = value;
    },

    setChangeMessage(state, value){
        state.changeMessage = value;
    },

      
  };

  export default{
      namespaced:true,
      state,
      getters,
      actions,
      mutations
  }
