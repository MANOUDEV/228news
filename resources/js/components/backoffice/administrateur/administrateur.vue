<script setup>
import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import Swal from 'sweetalert2';

const store = useStore();
const dataReady = ref(0);
const  meRoleName = ref(null); 

const show = async () => {
 
    if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

        await store.dispatch('roleSecurity/getMeRole', {});

        const gettersRoleStatus =  store.getters['roleSecurity/getRoleStatus'];
        const gettersMeRoleName =  store.getters['roleSecurity/getMeRoleName'];

        if(gettersRoleStatus === 'success'){

            meRoleName.value = gettersMeRoleName

            if((meRoleName.value == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbtsd!?')){

                dataReady.value = 1

            }else{ 
                dataReady.value= 2 
            } 

        }else if(gettersRoleStatus === 'failed'){

            dataReady.value = 3;
        }

    }else{

        dataReady.value = 4; 
    }
    
};

onMounted(() => {
  show();
});
</script>
<template>
    <div  v-if="dataReady == 0" >
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <div class="d-flex justify-content-center">
            <img :src="`/assets/images/logo.svg`"  style="width: 150px;" alt="empty">
        </div>
        <div class="d-flex justify-content-center mt-3">
            <div class="spinner-border text-success" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <br/><br/><br/><br/><br/><br/><br/><br/>
    </div>
    <div v-else-if="dataReady== 1">
        <HeaderAdmin></HeaderAdmin>
        <!-- **************** MAIN CONTENT START **************** -->
        <main>
            <!-- =======================Inner intro START -->
            <router-view></router-view>
        </main>
        <FooterAdmin></FooterAdmin>
    </div>
    <div v-else-if="dataReady== 2"> <accessUnAuthorizedAdmin></accessUnAuthorizedAdmin> </div>
    <div v-else-if="dataReady== 3"> <sessionExpiredMessageAdmin></sessionExpiredMessageAdmin> </div>
    <div v-else-if="dataReady== 4"> <authRequiredMessageAdmin></authRequiredMessageAdmin> </div>

</template> 