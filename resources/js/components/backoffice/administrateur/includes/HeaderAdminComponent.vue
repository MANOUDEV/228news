<template>
    <!-- =======================Header START -->
    <header class="navbar-light navbar-sticky header-static border-bottom navbar-dashboard">
        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <!-- Logo START -->
                <a class="navbar-brand me-3" href="/">
                    <img class="navbar-brand-item light-mode-item"  src="https://togoactu.com/assets/images/logo.png" alt="logo">
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
                        <li class="nav-item"><router-link style="font-size: 0.9375rem" class="nav-link" :to="{name: 'admin.dashboard'}"><i class="bi bi-house-door me-1"></i>Tableau de bord</router-link></li>



                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" style="font-size: 0.9375rem" href="#" id="pagesMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-pencil me-1"></i>Mes publications</a>
                            <ul class="dropdown-menu" aria-labelledby="pagesMenu">
                                <li> <router-link class="dropdown-item" :to="{name: 'admin.category'}">Mes catégories</router-link></li>
                                <li> <router-link class="dropdown-item" :to="{name: 'admin.tags'}">Mes Tags</router-link></li>
                                <li> <router-link class="dropdown-item"   to="#">Toutes mes publications</router-link></li>
                                <li> <a class="dropdown-item" href="#">Brouillons</a></li>
                                <li> <router-link class="dropdown-item" :to="{name: 'admin.publications.create'}">Créer une publication</router-link></li>
                            </ul>

                        </li>

                        <li class="nav-item"><router-link class="nav-link" style="font-size: 0.9375rem" to="#"><i class="bi bi-image me-1"></i>Mes fichiers</router-link></li>

                        <li class="nav-item"><router-link class="nav-link" style="font-size: 0.9375rem" :to="{name: 'admin.authors'}"><i class="bi bi-people-fill me-1"></i>Mes auteurs</router-link></li>




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
                            <i class="bi bi-envelope-fill"></i>
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
                                                        <img class="avatar-img rounded-circle" src="https://togoactu.com/assets/images/avatar/08.jpg" alt="avatar">
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
                                                        <img class="avatar-img rounded-circle" src="https://togoactu.com/assets/images/avatar/02.jpg" alt="avatar">
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
                                                        <img class="avatar-img rounded-circle" src="https://togoactu.com/assets/images/avatar/05.jpg" alt="avatar">
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
                                                        <img class="avatar-img rounded-circle" src="https://togoactu.com/assets/images/avatar/03.jpg" alt="avatar">
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
                                                        <img class="avatar-img rounded-circle" src="https://togoactu.com/assets/images/avatar/08.jpg" alt="avatar">
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
                                                        <img class="avatar-img rounded-circle" src="https://togoactu.com/assets/images/avatar/02.jpg" alt="avatar">
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
                                                        <img class="avatar-img rounded-circle" src="https://togoactu.com/assets/images/avatar/05.jpg" alt="avatar">
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
                                                        <img class="avatar-img rounded-circle" src="https://togoactu.com/assets/images/avatar/03.jpg" alt="avatar">
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
                            <li><router-link class="dropdown-item" :to="{name: 'admin.profile'}"><i class="bi bi-person fa-fw me-2"></i>Modifier mon profil</router-link></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-people-fill fa-fw me-2"></i>Gerer les utilisateurs</a></li>
                            <li><router-link class="dropdown-item" :to="{name: 'admin.newsletters'}"><i class="bi bi-send fa-fw me-2"></i> Les Newsletters</router-link></li>
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
<script>
import { mapGetters, mapActions, mapMutations } from "vuex";
import store from '../../../../store/index'
export default {
    // inside your script
    data () {
        return {
            dataReady: false,
            meProfileUserName: null,
            meProfileRoleName: null,
            logoutCheck: false,
            // other data
        }
    },
    computed: {
        ...mapGetters("meProfile",{
            gettersMeProfileUserName:"getMeProfileUserName",
            gettersMeProfileRoleName:"getMeProfileRoleName",
            gettersMeProfileStatus:'getMeProfileStatus',
        }),
        ...mapGetters("login", {
            gettersAuthData: "getAuthData",
        }),

        ...mapGetters('logout',{
            getterLogoutStatus:'getLogoutStatus',
            getterLogoutMessage:'getLogoutMessage',

        })
    },
    methods:{
      ...mapActions("meProfile",{
          actionsGetMeProfile:'getMeProfile'
      }),
      ...mapActions("logout",{
          actionsGetLogout:'getLogoutApi'
      }),

      ...mapMutations('login',{
            saveTokenData: 'saveTokenData'
      }),

      ...mapMutations('logout',{
            setlogout: 'setLogout'
      }),

      async show(){

        await this.actionsGetMeProfile();

        if(this.gettersMeProfileStatus === 'success'){

            this.meProfileRoleName = this.gettersMeProfileRoleName

            this.meProfileUserName = this.gettersMeProfileUserName

            this.dataReady = true;

        }
      },

      async logout(){

        this.logoutCheck = true

        await this.actionsGetLogout();

        if(this.getterLogoutStatus === 'success'){

            const Toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', this.$swal.stopTimer)
                    toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: this.getterLogoutMessage
            })

            const  clearToken = {
                access_token: null,
                expires_in: null
            }

            store.getters["login/getAuthData"].access_token = clearToken.access_token
            store.getters["login/getAuthData"].expires_in = clearToken.expires_in

           window.location = '/auth/login'

           this.logoutCheck = false

        }

      },
    },
    mounted() {
     this.show();
    },
};
</script>
