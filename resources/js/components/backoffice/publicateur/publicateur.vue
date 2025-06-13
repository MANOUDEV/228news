<template>
    <div  v-if="dataReady == 0" >
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <div class="d-flex justify-content-center">
            <img src="https://actualitetogo.com/assets/images/logo.png"  style="width: 150px;" alt="empty">
        </div>
        <div class="d-flex justify-content-center mt-3">
            <div class="spinner-border text-success" style="color: #006633" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <br/><br/><br/><br/><br/><br/><br/><br/>
    </div>
    <div v-else-if="dataReady== 1">
        <HeaderPub></HeaderPub>
        <!-- **************** MAIN CONTENT START **************** -->
        <main>
            <!-- =======================Inner intro START -->
            <router-view></router-view>
        </main>
        <FooterPub></FooterPub>
    </div>
    <div v-else-if="dataReady== 2"> <accessUnAuthorizedPub></accessUnAuthorizedPub> </div>
    <div v-else-if="dataReady== 3"> <sessionExpiredMessagePub></sessionExpiredMessagePub> </div>
    <div v-else-if="dataReady== 4"> <authRequiredMessagePub></authRequiredMessagePub> </div>

</template>
<script>
import { mapGetters, mapActions} from "vuex";
export default {
    // inside your script
    data () {
        return {
            dataReady: 0,
            meRoleName: null,
        }
    },
    computed: {
        ...mapGetters("roleSecurity",{
            gettersMeRoleName:"getMeRoleName",
            gettersRoleStatus:'getRoleStatus',
        }),

    },
    methods:{
      ...mapActions("roleSecurity",{
          actionsGetMeRole:'getMeRole'
      }),

      async show(){

        if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

            await this.actionsGetMeRole();

            if(this.gettersRoleStatus === 'success'){

                this.meRoleName = this.gettersMeRoleName

                if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbrsp?!')){

                    this.dataReady = 1

                }else{

                    this.dataReady= 2

                }



            }else if(this.gettersRoleStatus === 'failed'){

                this.dataReady = 3;

            }

        }else{

            this.dataReady = 4;

        }


      },

      expiredSessionModalClose(){
        $('#expiredSessionModal').modal('hide')
      }

    },
    mounted() {
     this.show();
    },
};
</script>
