<script setup>
import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import Swal from 'sweetalert2';

const store = useStore();
const dataReady = ref(0);
const meProfileUserName = ref(null);
const meProfileRoleName = ref(null);
const meProfileEmail = ref(null); 
const logoutCheck = ref(false);
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
    const  clearToken = {
      access_token: null,
      expires_in: null
    }

    store.getters["login/getAuthData"].access_token = clearToken.access_token
    store.getters["login/getAuthData"].expires_in = clearToken.expires_in

    window.location = '/auth/login'

    this.logoutCheck = false
    window.location = '/auth/login';
  }
};

onMounted(() => {
  show();
});
</script>
<template>
    <!-- =======================Header START -->
    <header class="navbar-light navbar-sticky header-static border-bottom navbar-dashboard">
        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <!-- Logo START -->
                <a class="navbar-brand me-3" href="/">
                    <img class="navbar-brand-item light-mode-item" :src="`/assets/images/logo.svg`" alt="logo">
                </a>
                <!-- Logo END -->


                <!-- Responsive navbar toggler -->
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-body h6 d-none d-sm-inline-block">Menu</span>
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Main navbar START -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav navbar-nav-scroll mx-auto">

                        <!-- Nav item 1 Demos -->
                        <li class="nav-item"><router-link style="font-size: 0.9375rem" class="nav-link" :to="{name: 'pub.dashboard'}"><i class="bi bi-house-door me-1"></i>Tableau de bord</router-link></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="pagesMenu" style="font-size: 0.9375rem" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-pencil me-1"></i>Mes publications</a>
                            <ul class="dropdown-menu" aria-labelledby="pagesMenu">
                                <li> <router-link class="dropdown-item" to="#">Mes Tags</router-link></li>
                                <li> <a class="dropdown-item" href="#">Toutes mes publications</a></li>
                                <li> <a class="dropdown-item" href="#">Brouillons</a></li>
                                <li> <router-link class="dropdown-item" to="#">Créer une publication</router-link></li>
                            </ul>

                        </li>

                        <li class="nav-item"><router-link class="nav-link" style="font-size: 0.9375rem" to="#"><i class="bi bi-image me-1"></i>Mes fichiers</router-link></li>

                        <li class="nav-item"><router-link class="nav-link" style="font-size: 0.9375rem"  to="#"><i class="bi bi-user me-1"></i>Mes auteurs</router-link></li>
                        
                    </ul>


                    <!-- Search dropdown END -->
                </div>
                <!-- Main navbar END -->

                <!-- Nav right START -->
                <div class="nav flex-nowrap align-items-center">

                      <!-- Notification dropdown START -->
                      <div class="nav-item ms-2 ms-md-3 dropdown">
                        <!-- Notification button -->
                        <a class="btn btn-primary-soft btn-round mb-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <i class="bi bi-bell fa-fw"></i>
                        </a>
                        <!-- Notification dote -->
                        <span class="notif-badge animation-blink"></span>

                        <!-- Notification dropdown menu START -->
                        <div class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0">
                            <div class="card bg-transparent">
                                <div class="card-header bg-transparent border-bottom p-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0">Notifications <span class="badge bg-danger bg-opacity-10 text-danger ms-2">2 new</span></h6>
                                    <a class="small" href="#">Clear all</a>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-unstyled list-group-flush">
                                        <!-- Notif item -->
                                        <li>
                                            <a href="#" class="list-group-item-action border-0 border-bottom d-flex p-3">
                                                <div class="me-3">
                                                    <div class="avatar avatar-sm">
                                                        <img class="avatar-img rounded-circle" :src="`/assets/images/avatar/08.jpg`" alt="avatar">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">12 new members joined</h6>
                                                    <span class="small"> <i class="bi bi-clock"></i> 3 min ago</span>
                                                </div>
                                            </a>
                                        </li>

                                        <!-- Notif item -->
                                        <li>
                                            <a href="#" class="list-group-item-action border-0 border-bottom d-flex p-3">
                                                <div class="me-3">
                                                    <div class="avatar avatar-sm">
                                                        <img class="avatar-img rounded-circle" :src="`/assets/images/avatar/02.jpg`" alt="avatar">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Larry Lawson deleted account</h6>
                                                    <span class="small"> <i class="bi bi-clock"></i> 6 min ago</span>
                                                </div>
                                            </a>
                                        </li>

                                        <!-- Notif item -->
                                        <li>
                                            <a href="#" class="list-group-item-action border-0 border-bottom d-flex p-3">
                                                <div class="me-3">
                                                    <div class="avatar avatar-sm">
                                                        <img class="avatar-img rounded-circle" :src="`/assets/images/avatar/05.jpg`" alt="avatar">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Byan commented on your post</h6>
                                                    <span class="small"> <i class="bi bi-clock"></i> 10 min ago</span>
                                                </div>
                                            </a>
                                        </li>

                                        <!-- Notif item -->
                                        <li>
                                            <a href="#" class="list-group-item-action border-0 border-bottom d-flex p-3">
                                                <div class="me-3">
                                                    <div class="avatar avatar-sm">
                                                        <img class="avatar-img rounded-circle" :src="`/assets/images/avatar/03.jpg`" alt="avatar">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Settings updated</h6>
                                                    <span class="small"> <i class="bi bi-clock"></i> Yesterday</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Button -->
                                <div class="card-footer bg-transparent border-0 py-3 text-center position-relative">
                                    <a href="#" class="stretched-link">See all incoming activity</a>
                                </div>
                            </div>
                        </div>
                        <!-- Notification dropdown menu END -->
                    </div>
                    <!-- Notification dropdown END -->

                    <!-- Profile dropdown START -->
                    <div class="nav-item ms-2 ms-md-3 dropdown">
                        <!-- Avatar -->
                        <a class="btn btn-primary-soft btn-round mb-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <i class="bi bi-person"></i>
                        </a>

                        <!-- Profile dropdown START -->
                        <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
                            <!-- Profile info -->
                            <li class="px-3">
                                <div class="d-flex align-items-center">
                                    <!-- Avatar -->
                                    <div class="btn btn-primary-soft btn-round mb-0 ">
                                        <i class="bi bi-person" ></i>
                                    </div>
                                    &nbsp; &nbsp; &nbsp;
                                    <div v-if="dataReady">
                                        <a class="h6 mt-2 mt-sm-0" href="#">{{meProfileUserName}}</a>
                                        <p class="small m-0">{{meProfileRoleName}}</p>
                                    </div>
                                </div>
                                <hr>
                            </li>
                            <!-- Links -->
                            <li><router-link class="dropdown-item" to="#"><i class="bi bi-person fa-fw me-2"></i>Editer mon profil</router-link></li>
                            <li>
                                <span class="dropdown-item" v-if="!logoutCheck" style="cursor: pointer" @click="logout"><i class="bi bi-power fa-fw me-2"></i>Se deconnecter</span>
                                <span class="dropdown-item" v-else ><i class="bi bi-power fa-fw me-2"></i>Déconnexion en cours ...</span>
                            </li>

                        </ul>
                        <!-- Profile dropdown END -->
                    </div>
                    <!-- Profile dropdown END -->

                <!-- Nav right END -->
                </div>
            </div>
        </nav>
    </header>
    <!-- =======================Header END -->
</template>

