<script setup>
import { ref, onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const dataReady = ref(0);
const meRoleName = ref(null);

const show = async () => {
  if (localStorage.getItem('access_token') && localStorage.getItem('nbRsp')) {
    await store.dispatch('roleSecurity/getMeRole');
    
    const roleStatus = store.getters['roleSecurity/getRoleStatus'];
    const roleName = store.getters['roleSecurity/getMeRoleName'];
    
    if (roleStatus === 'success') {
      meRoleName.value = roleName;
      
      if (meRoleName.value === localStorage.getItem('nbRsp') && localStorage.getItem('nbRsp') === '&nbrsp?!') {
        dataReady.value = 1;
      } else {
        dataReady.value = 2;
      }
    } else if (roleStatus === 'failed') {
      dataReady.value = 3;
    }
  } else {
    dataReady.value = 4;
  }
};

onMounted(() => {
  show();
});
</script>

<template>
  <div v-if="dataReady === 0">
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <div class="d-flex justify-content-center">
      <img :src="`/assets/images/logo.svg`" style="width: 150px;" alt="empty" />
    </div>
    <div class="d-flex justify-content-center mt-3">
      <div class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br />
  </div>

  <div v-else-if="dataReady === 1">
    <HeaderPub />
    <main>
      <router-view />
    </main>
    <FooterPub />
  </div>

  <div v-else-if="dataReady === 2">
    <accessUnAuthorizedPub />
  </div>
  <div v-else-if="dataReady === 3">
    <sessionExpiredMessagePub />
  </div>
  <div v-else-if="dataReady === 4">
    <authRequiredMessagePub />
  </div>
</template>
