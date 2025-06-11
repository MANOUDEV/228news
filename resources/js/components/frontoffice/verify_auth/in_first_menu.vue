<script setup>
import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import Swal from 'sweetalert2';

const store = useStore();
const dataReady = ref(0);
const meProfileUserName = ref(null);
const meProfileRoleName = ref(null);
const loadingConnect = ref(false);
const remember_me = ref(false);




const show = async () => {
  if (localStorage.getItem('access_token') && localStorage.getItem('nbRsp')) {
    await store.dispatch('meProfile/getMeProfile');
    const gettersMeProfileUserName =  store.getters['meProfile/getMeProfileUserName'];
    const gettersMeProfileRoleName =  store.getters['meProfile/getMeProfileRoleName'];
    const gettersMeProfileStatus =  store.getters['meProfile/getMeProfileStatus'];
    if (gettersMeProfileStatus === 'success') {
      meProfileRoleName.value = gettersMeProfileRoleName;
      meProfileUserName.value = gettersMeProfileUserName;
      dataReady.value = 1;
    } else if (gettersMeProfileStatus === 'failed') {
      dataReady.value = 3;
    }
  } else {
    dataReady.value = 2;
  }
};

const loginClick = async () => {
  if (localStorage.getItem('remember_me') === 'true' && localStorage.getItem('username') && localStorage.getItem('password')) {
    loadingConnect.value = true;
    remember_me.value = localStorage.getItem('remember_me');

    await store.dispatch('login/login', {
      username: localStorage.getItem('username'),
      password: localStorage.getItem('password'),
      remember_me: localStorage.getItem('remember_me')
    });

    const getterLoginStatus =  store.getters['login/getLoginStatus'];
    const getterLoginMessage =  store.getters['login/getLoginMessage'];

    if (getterLoginStatus.includes('success')) {
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: getterLoginMessage,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
      });
      const redirectPath = getterLoginStatus.includes('admin') ? '/admin/dashboard' : getterLoginStatus.includes('pub') ? '/pub/dashboard' : '/';
      window.location = redirectPath;
    } else {
      window.location = '/auth/login';
    }
  } else {
    window.location = '/auth/login';
  }
};

onMounted(() => {
  show();
});
</script>

<template>
  <span v-if="dataReady === 0"></span>
  <span v-else-if="dataReady === 1">
    <span v-if="meProfileRoleName === 'Administrateur'">
      <a class="nav-link text-dark" href="/admin/dashboard">Tableau de bord</a>
    </span>
    <span v-else-if="meProfileRoleName === 'Publicateur d\' articles'">
      <a class="nav-link text-dark" href="/pub/dashboard">Tableau de bord</a>
    </span>
    <span v-else-if="meProfileRoleName === 'Visiteur'">
      <a class="nav-link text-dark" href="/profile">Voir mon profil</a>
    </span>
  </span>
  <span v-else-if="dataReady === 2 || dataReady === 3">
    <span class="nav-link text-dark" v-if="!loadingConnect" @click="loginClick" style="cursor: pointer">Se connecter</span>
    <span class="nav-link text-dark" v-else>Connexion en cours ...</span>
  </span>
</template>
