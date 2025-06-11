import jwtInterceptor  from '../../../shared/jwtInterceptor';

const state = () => ({
  meProfileUserName :  null,
  meProfileName :  null,
  meProfileEmail :  null,
  meProfileRoleName:  null,

  meProfileStatus: null,
  meProfileData: null,
  meProfileMessage: null, 
  meProfileErrors: null,
 
  meProfileUpdateStatus: null,
  meProfileUpdateData: null,
  meProfileUpdateMessage: null, 
  meProfileUpdateErrors: null,

  
  mePasswordUpdateStatus: null,
  mePasswordUpdateData: null,
  mePasswordUpdateMessage: null, 
  mePasswordUpdateErrors: null,
});

const getters = {
    getMeProfileUserName(state){
    return  state.meProfileUserName;
    },
    getMeProfileRoleName(state){
        return state.meProfileRoleName;
    },
    getMeProfileStatus(state){
        return state.meProfileStatus;
    },
    getMeProfileEmail(state){
        return state.meProfileEmail;
    },
    getMeProfileName(state){
        return state.meProfileName;
    },

    getMeProfileData(state){
      return state.meProfileData;
    },

    getMeProfileMessage(state){
      return state.meProfileMessage;
    },
 
    getMeProfileErrors(state){
      return state.meProfileErrors;
    },


    getMeProfileUpdateStatus(state){
      return state.meProfileUpdateStatus;
    },

    getMeProfileUpdateData(state){
      return state.meProfileUpdateData;
    },

    getMeProfileUpdateMessage(state){
      return state.meProfileUpdateMessage;
    }, 

    getMeProfileUpdateErrors(state){
      return state.meProfileUpdateErrors;
    },


    getMePasswordUpdateStatus(state){
      return state.mePasswordUpdateStatus;
    },

    getMePasswordUpdateData(state){
      return state.mePasswordUpdateData;
    },

    getMePasswordUpdateMessage(state){
      return state.mePasswordUpdateMessage;
    }, 

    getMePasswordUpdateErrors(state){
      return state.mePasswordUpdateErrors;
    },

};

const actions = {
    async getMeProfile({commit}){
        var response = await jwtInterceptor.post('me').catch((err) =>{
          if(err.response.status == 401){
            commit("setMeProfileStatus", "expired");
          }
        });
        if(response && response.data.data.status == 200){
            commit("setMeProfileStatus", "success");
            commit('setMeProfileUserName', response.data.data.user.username);
            commit('setMeProfileEmail', response.data.data.user.email);
            commit('setMeProfileName', response.data.data.user.prenoms);
            commit('setMeProfileRoleName', response.data.data.user.role_name);
            commit('setMeProfileData', response.data.data.user);
            commit('setMeProfileMessage', response.data.message);
        }else{
          commit("setMeProfileStatus", "failed");
        }
    },

    async updateMeProfile({ commit },  payload){
      var response = await jwtInterceptor.put('updateMeProfile', payload).catch((err) =>{
        if(err.response.status == 401){
          commit("setMeProfileUpdateStatus", "expired");
        }
      });
      if(response && response.data.data.status == 200){
          commit("setMeProfileUpdateStatus", "success"); 
          commit('setMeProfileUpdateData', response.data.data.user);
          commit('setMeProfileUpdateMessage', response.data.message);
      }else{
        commit("setMeProfileUpdateStatus", "failed");
      }
    },

    async updateMePassword({ commit },  payload){
      var response = await jwtInterceptor.put('updateMePassword', payload).catch((err) =>{
        if(err.response.status == 401){
          commit("setMePasswordUpdateStatus", "expired");
        }
      });
      if(response && response.data.data.status == 200){
          commit("setMePasswordUpdateStatus", "success"); 
          commit('setMePasswordUpdateData', response.data.data.user);
          commit('setMePasswordUpdateMessage', response.data.message);
      }else{
        commit("setMePasswordUpdateStatus", "empty");
        commit('setMePasswordUpdateErrors', response.data.data.errors);
          commit('setMePasswordUpdateMessage', response.data.message);
      }
  },

};

const mutations = {
  setMeProfileUserName(state, value){
   state.meProfileUserName = value;
  },

  setMeProfileRoleName(state, value){
    state.meProfileRoleName = value;
   },

  setMeProfileStatus(state, value){
    state.meProfileStatus = value;
  },

  setMeProfileName(state, value){
    state.meProfileName= value;
  },

  setMeProfileEmail(state, value){
    state.meProfileEmail = value;
  },

  setMeProfileData(state, value){
    state.meProfileData = value;
  },
  setMeProfileMessage(state, value){
    state.meProfileMessage = value;
  },
  setMeProfileErrors(state, value){
    state.meProfileErrors = value;
  },

  setMeProfileUpdateStatus(state, value){
    state.meProfileUpdateStatus = value;
  },
  setMeProfileUpdateData(state, value){
    state.meProfileUpdateData = value;
  },
  setMeProfileUpdateMessage(state, value){
    state.meProfileUpdateMessage = value;
  },
  setMeProfileUpdateErrors(state, value){
    state.meProfileUpdateErrors = value;
  },

  setMePasswordUpdateStatus(state, value){
    state.mePasswordUpdateStatus = value;
  },
  setMePasswordUpdateData(state, value){
    state.mePasswordUpdateData = value;
  },
  setMePasswordUpdateMessage(state, value){
    state.mePasswordUpdateMessage = value;
  },
  setMePasswordUpdateErrors(state, value){
    state.mePasswordUpdateErrors = value;
  },
};

export default{
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
