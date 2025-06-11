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

</script>
<template>
    <section class="overflow-hidden">
        <div class="container">
            <div class="row">
        <div class="col-md-9 text-center mx-auto my-0 my-md-5 py-0 py-lg-5 position-relative z-index-9">
            <!-- SVG shape START -->
            <figure class="position-absolute top-50 start-50 translate-middle opacity-7 z-index-n9">
            <svg width="650" height="379" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"  viewBox="0 0 510 297">
                <g>
                <path class="fill-primary opacity-1" d="M121,147.4c0,6-4.8,10.8-10.8,10.8H47.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                c6,0,10.8,4.8,10.8,10.8V147.4z"/>
                <path class="fill-primary opacity-1" d="M179.4,90.2c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8V78.7c0-6,4.8-10.8,10.8-10.8h62.6
                c6,0,10.8,4.8,10.8,10.8V90.2z"/>
                <path class="fill-primary opacity-1" d="M459.1,26.3c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8V14.8c0-6,4.8-10.8,10.8-10.8h62.6
                c6,0,10.8,4.8,10.8,10.8V26.3z"/>
                <path class="fill-primary opacity-1" d="M422.1,66.9c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8V55.3c0-6,4.8-10.8,10.8-10.8h62.6
                c6,0,10.8,4.8,10.8,10.8V66.9z"/>
                <path class="fill-primary opacity-1" d="M275.8,282.6c0,5.9-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                c6,0,10.8,4.8,10.8,10.8V282.6z"/>
                <path class="fill-primary opacity-1" d="M87.7,42.9c0,5.9-4.8,10.8-10.8,10.8H14.3c-6,0-10.8-4.8-10.8-10.8V31.4c0-6,4.8-10.8,10.8-10.8h62.6
                c6,0,10.8,4.8,10.8,10.8V42.9z"/>
                <path class="fill-primary opacity-1" d="M505.9,123.4c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                c6,0,10.8,4.8,10.8,10.8V123.4z"/>
                <path class="fill-primary opacity-1" d="M482.5,204.9c0,5.9-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                c5.9,0,10.8,4.8,10.8,10.8V204.9z"/>
                <path class="fill-primary opacity-1" d="M408.3,258.8c0,5.9-4.8,10.8-10.8,10.8H335c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                c6,0,10.8,4.8,10.8,10.8V258.8z"/>
                <path class="fill-primary opacity-1" d="M147,252.5c0,5.9-4.8,10.8-10.8,10.8H73.6c-6,0-10.8-4.8-10.8-10.8V241c0-5.9,4.8-10.8,10.8-10.8h62.6
                c6,0,10.8,4.8,10.8,10.8V252.5z"/>
                </g>
            </svg>
            </figure>
            <!-- SVG shape START -->
            <!-- Content -->
            <h1 class="display-1 text-primary">Oops</h1>
            <h5>Veuillez vous connecter afin de pouvoir acceder à cette page</h5>
            <span style="cursor: pointer"  v-if="!loadingConnect" @click="loginClick" class="btn btn-danger-soft mt-3"><i class="fas fa-long-arrow-alt-left me-3"></i>Se connecter</span>
            <span  v-else-if="loadingConnect"  class="btn btn-danger-soft mt-3">Connexion en cours ...</span>
        </div>
        </div>

        </div>
    </section>
</template> 