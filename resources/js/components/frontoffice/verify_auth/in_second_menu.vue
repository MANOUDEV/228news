<script setup>
import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import Swal from 'sweetalert2';

const store = useStore();
const dataReady = ref(0);
const meProfileUserName = ref(null);
const meProfileRoleName = ref(null);
const meProfileEmail = ref(null);
const loadingConnect = ref(false);
const logoutCheck = ref(false);

const show = async () => {
  if (localStorage.getItem('access_token') && localStorage.getItem('nbRsp')) {
    await store.dispatch('meProfile/getMeProfile');
    
    const gettersMeProfileUserName =  store.getters['meProfile/getMeProfileUserName'];
    const gettersMeProfileRoleName =  store.getters['meProfile/getMeProfileRoleName'];
    const gettersMeProfileEmail =  store.getters['meProfile/getMeProfileEmail'];
    const gettersMeProfileStatus =  store.getters['meProfile/getMeProfileStatus'];  

    if (gettersMeProfileStatus === 'success') {
      meProfileRoleName.value = gettersMeProfileRoleName;
      meProfileUserName.value = gettersMeProfileUserName;
      meProfileEmail.value = gettersMeProfileEmail;
      dataReady.value = 1;
    } else {
      dataReady.value = 2;
    }
  } else {
    dataReady.value = 2;
  }
};

const logout = async () => {
  logoutCheck.value = true;
  await store.dispatch('logout/getLogoutApi');
  const getterLogoutStatus =  store.getters['logout/getLogoutStatus'];
  const getterLogoutMessage =  store.getters['logout/getLogoutMessage'];
  if (getterLogoutStatus === 'success') {
    Swal.fire({
      toast: true,
      position: 'top-end',
      icon: 'success',
      title: getterLogoutMessage,
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true
    });
    window.location = '/auth/login';
  }
};

onMounted(() => {
  show();
});
</script>

<template>
  <div v-if="dataReady === 0 "> 
    <a class="btn btn-primary-soft btn-round mb-0" href="/auth/login">
      <i style="font-size: 25px" class="bi bi-person fa-fw"></i>
    </a>
  </div>
  <div v-else-if="dataReady === 2">
    <a class="btn btn-primary-soft btn-round mb-0" href="/auth/login">
      <i style="font-size: 25px" class="bi bi-person fa-fw"></i>
    </a>
  </div>
  <div class="nav-item ms-2 ms-md-3 dropdown" v-else-if="dataReady === 1">
    <a class="avatar avatar-xs" href="#" role="button" data-bs-toggle="dropdown">
      <div class="avatar-img rounded-circle bg-primary">
        <span  style="font-size: 25px" class="text-light position-absolute top-50 start-50 translate-middle fw-bold small">
          {{ meProfileUserName[0].toUpperCase() }}
        </span>
      </div>
    </a>
    <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3">
      <li class="px-3">
        <div class="d-flex align-items-center">
          <div class="avatar avatar-xs">
            <div class="avatar-img rounded-circle bg-primary">
              <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold small">
                {{ meProfileUserName[0].toUpperCase() }}
              </span>
            </div>
          </div>
          &nbsp; &nbsp; &nbsp;
          <div>
            <a class="h6 mt-2 mt-sm-0" href="#">{{ meProfileUserName }}</a>
            <p class="small m-0">{{ meProfileEmail }}</p>
          </div>
        </div>
        <hr>
      </li>
      <li><a class="dropdown-item" href="/auth/profile"><i class="bi bi-person fa-fw me-2"></i>Editer mon profil</a></li>
      <li v-if="meProfileRoleName === 'Administrateur'"><a class="dropdown-item" href="/admin/dashboard"><i class="bi bi-house-door fa-fw me-2"></i>Tableau de bord</a></li>
      <li v-else-if="meProfileRoleName === 'Publicateur d\' articles'"><a class="dropdown-item" href="/pub/dashboard"><i class="bi bi-house-door fa-fw me-2"></i>Tableau de bord</a></li>
      <li>
        <span class="dropdown-item" v-if="!logoutCheck" style="cursor: pointer" @click="logout"><i class="bi bi-power fa-fw me-2"></i>Se déconnecter</span>
        <span class="dropdown-item" v-else><i class="bi bi-power fa-fw me-2"></i>Déconnexion en cours ...</span>
      </li>
    </ul>
  </div>
</template>
