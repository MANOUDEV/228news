<template>
    <!-- **************** MAIN CONTENT START **************** -->
    <main style="margin-top: -45px; margin-bottom: -35px;">
        <!-- =======================Inner intro START -->
        <div v-if="dataReady == 0">
            <br><br><br> <br><br><br>
            <div class="d-flex justify-content-center mt-3">
                <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <br><br><br><br><br><br>
        </div>
        <section v-if="dataReady == 2">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                        <div class="p-4 p-sm-5 bg-primary bg-opacity-10 rounded">
                            <h2>Page de connexion</h2>
                            <!-- Form START -->
                            <div v-if="error">
                                <br>
                                <div class="alert alert-danger"  role="alert">
                                    {{ error }}
                                </div>
                            </div>
                            <form class="mt-4">
                                <!-- Email -->
                                <div class="mb-3" v-if="errors.username">
                                    <label class="form-label" for="exampleInputEmail1">Nom d'utilisateur ou votre email</label>
                                    <input type="text" v-model="username" name="username" class="form-control is-invalid" id="exampleInputEmail1" placeholder="Votre nom d'utilisateur ou votre email">
                                    <div id="exampleInputEmail1" v-for="errorUsername in errors.username" :key="errorUsername" class="invalid-feedback">
                                        {{ errorUsername }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputEmail1">Nom d'utilisateur ou votre email</label>
                                    <input type="text" v-model="username" name="username" class="form-control" id="exampleInputEmail1" placeholder="Votre nom d'utilisateur ou votre email">
                                   
                                </div>
                                <!-- Password -->
                                <div class="mb-3" v-if="errors.password">
                                    <label class="form-label" for="exampleInputPassword1">Mot de passe</label>
                                     
                                    <div class="input-group">
                                        <input v-model="password" name="password" class="form-control fakepassword" type="password" id="psw-input" placeholder="*********">
                                        <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                            <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                    <div id="exampleInputPassword1" v-for="errorPassword in errors.password" :key="errorPassword" class="invalid-feedback">
                                        {{ errorPassword }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label"  for="exampleInputPassword1">Mot de passe</label>
                                    <div class="input-group">
                                        <input v-model="password" name="password" class="form-control fakepassword" type="password" id="psw-input" placeholder="*********">
                                        <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                            <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                </div>
                                <!-- Checkbox -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="remember_me" v-model="remember_me" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
                                </div>
                                <!-- Button -->
                                <div class="row align-items-center">
                                    <div class="col-sm-4">
                                        <button type="button" disabled v-if="loading" class="btn btn-success"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                            <span class="sr-only">Loading...</span>  Connexion</button>
                                        <button    @click.prevent="saveNewsletter" v-else class="btn btn-success">Se connecter</button>
                                    
                                    </div>
                                    <div class="col-sm-8 text-sm-end">
                                        <span><a href="/auth/forgot_password"><u>Mot de passe oublié ?</u></a></span>
                                    </div>                                    

                                </div>

                                <div class="row mt-3 align-items-center">
                                    <div class="col-sm-12 text-center">
                                        <span>Ne disposez-vous pas d'un compte?&nbsp;<a href="/auth/register"><u>S'inscrire</u></a></span>
                                    </div>
                                </div>

                            </form>
                            <hr>
                            <div class="mt-3 text-center">
                                <p>Se connecter par le canal des réseaux sociaux</p>
                                <ul class="list-unstyled d-sm-flex mt-3 justify-content-center">
                                    <li class="mx-2">
                                        <a href="#" class="btn bg-facebook d-inline-block"><i class="fab fa-facebook-f me-2"></i> &nbsp; Facebook</a>
                                    </li>
                                    <li class="mx-2">
                                        <a href="#" class="btn bg-google d-inline-block"><i class="fab fa-google me-2"></i> &nbsp; Google</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="overflow-hidden" v-else-if="dataReady == 1">
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
                        <h2 class=" text-primary">Vous êtes déjà connecté.</h2>
                        <p>Vous n'avez plus besoin de vous connecter encore.</p>
                        <a href="/admin/dashboard" v-if="meProfileRoleName === 'Administrateur'" class="btn btn-danger-soft mt-3">Tableau de bord.<i class="fas fa-long-arrow-alt-right me-3"></i></a>
                        <a href="/pub/dashboard" v-else-if="meProfileRoleName === 'Publicateur d\' articles'" class="btn btn-danger-soft mt-3">Tableau de bord.</a>
                        <a href="/" v-else-if="meProfileRoleName === 'Visiteur'" class="btn btn-danger-soft mt-3"><i class="fas fa-long-arrow-alt-left me-3"></i>Page d'accueil.</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================Inner intro END -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->
    <div class="modal fade" id="verifyCaptchaLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title">Vérification CAPTCHA</h5>
                    <button type="button" class="btn-close" @click="verifyCaptchaLoginClose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"  > 
                        <div class="input-btn">
                            <div class="input-img">
                              <input type="text" class="form-control captcha-text" v-model="captchaRandomNumber" disabled />
                              <img :src="`/assets/images/captcha.jpg`" alt=""/>
                            </div>
                            <button class="refresh-btn" @click="reloadcaptchaRandomNumber">
                              <i class="fas fa-rotate-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3"  > 
                        <div class="input-btn">
                            <div class="input-img">
                              <input type="text" class="form-control " v-model="captchaRandomVerify" /> 
                            </div>
                            <button class="refresh-btn" @click="save">
                              <i class="fas fa-arrow-right"></i>
                            </button> 
                        </div>
                        <small class="text-danger" v-if="messageCaptcha">{{ messageCaptcha }}</small>
                    </div>
                </div>  
                <div class="modal-footer"> </div>
                <div  style="margin-top: -15px">
                    <p class="text-center">Verifions si vous n'êtes pas un robot</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data(){
            return{
                username:null,
                password: null,
                loginError: false,
                loading: false,
                error: false,
                errors: [],
                dataReady: 0,
                meProfileRoleName: null,
                remember_me: false,
                showPsw: false,
                captchaRandomNumber: null,
                captchaRandomVerify: null,
                messageCaptcha:null,
                authState: false,
            }
        },
        computed:{
            ...mapGetters('login',{
                getterLoginStatus:'getLoginStatus',
                getterLoginMessage:'getLoginMessage',
                getterLoginErrors:'getLoginErrors',
            }),
            ...mapGetters("meProfile",{
                gettersMeProfileStatus:'getMeProfileStatus',
                gettersMeProfileRoleName:"getMeProfileRoleName",
            }),
        },
        methods:{
            ...mapActions('login',{
                actionLogin:'login'
            }),
            ...mapActions("meProfile",{
                actionsGetMeProfile:'getMeProfile'
            }),

            showPassword(){
                var x = document.getElementById("psw-input");
                if (x.type === "password") {
                    x.type = "text";
                    this.showPsw = true
                } else {
                    x.type = "password";
                    this.showPsw = false
                }
            },

            verifyCaptchaLoginClose(){ 
                this.generateCaptcha()
                this.messageCaptcha = null
                this.captchaRandomVerify = null
                $('#verifyCaptchaLogin').modal('hide');
            },

            verifyCaptchaLoginShow(){ 
                this.generateCaptcha()
                $('#verifyCaptchaLogin').modal('show');
            },

            reloadcaptchaRandomNumber(){
                this.generateCaptcha()
            },

            generateCaptcha(){
                const randomString = Math.random().toString(36).substring(2, 7);
                const randomStringArray = randomString.split("");
                const changeString = randomStringArray.map((char) =>
                    Math.random() > 0.5 
                    ? char.toUpperCase() 
                    : char
                );

                this.captchaRandomNumber = changeString.join(""); 
            }, 

            saveNewsletter(){ 
                this.generateCaptcha()
                this.verifyCaptchaLoginShow() 
            },

            save(){
                this.messageCaptcha = null
                if(this.captchaRandomVerify != this.captchaRandomNumber){

                    this.messageCaptcha="Veuillez entrer un captcha valide."

                }else{
                    this.messageCaptcha = null
                    this.verifyCaptchaLoginClose()
                    this.submitLogin()
                }
            }, 
            async show(){

                if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                    await this.actionsGetMeProfile();

                    if(this.gettersMeProfileStatus === 'success'){

                        this.meProfileRoleName = this.gettersMeProfileRoleName

                        this.dataReady = 1
 
                        if(localStorage.getItem('remember_me') == "true"  &&  localStorage.getItem('username') && localStorage.getItem('password')){

                            this.username = localStorage.getItem('username')

                            this.password = localStorage.getItem('password')

                            this.remember_me = localStorage.getItem('remember_me')

                        }

                    }else if(this.gettersMeProfileStatus === 'failed'){

                        this.dataReady = 2;

                        if(localStorage.getItem('remember_me') == "true"  && localStorage.getItem('username') && localStorage.getItem('password')){

                            this.username = localStorage.getItem('username')

                            this.password = localStorage.getItem('password')

                             

                        }

                    }

                }else{ 
 
                     this.dataReady = 2;

                    if(localStorage.getItem('remember_me') == "true" && localStorage.getItem('username') && localStorage.getItem('password')){

                        this.username = localStorage.getItem('username')

                        this.password = localStorage.getItem('password')

                        this.remember_me = localStorage.getItem('remember_me')

                    }

                }
            },
            async submitLogin(){
                this.loading = true
                this.error = false
                this.errors =  []
                await this.actionLogin({username:this.username, password:this.password, remember_me: this.remember_me});


                if(this.getterLoginStatus === 'success admin'){

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
                        title: this.getterLoginMessage
                    })

                    this.error = false
                    this.errors =  []

                    if(this.remember_me){

                        localStorage.setItem('username', this.username )

                        localStorage.setItem('password', this.password)

                        localStorage.setItem('remember_me', true)

                        this.loading = false

                        window.location = '/admin/dashboard'


                    }else{

                        localStorage.setItem('remember_me', false)

                        this.loading = false

                        window.location = '/admin/dashboard'
                    }



                }else if(this.getterLoginStatus === 'success pub'){

                    this.error = false
                    this.errors =  []

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
                        title: this.getterLoginMessage
                    })

                    if(this.remember_me){

                        localStorage.setItem('username', this.username )

                        localStorage.setItem('password', this.password)

                        localStorage.setItem('remember_me', true)

                        this.loading = false

                        window.location = '/pub/dashboard'


                    }else{

                        localStorage.setItem('remember_me', false)

                        this.loading = false

                        window.location = '/pub/dashboard'
                    }



                }else if(this.getterLoginStatus === 'success visitor'){

                    this.error = false
                    this.errors =  []

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
                        title: this.getterLoginMessage
                    })

                    if(this.remember_me){

                        localStorage.setItem('username', this.username )

                        localStorage.setItem('password', this.password)

                        localStorage.setItem('remember_me', true)

                        this.loading = false

                        window.location = '/'


                    }else{

                        localStorage.setItem('remember_me', false)

                        this.loading = false

                        window.location = '/'
                    }



                }else if(this.getterLoginStatus === 'failed'){

                    this.error = this.getterLoginMessage

                    this.errors = []

                    this.loading = false

                }else if(this.getterLoginStatus === 'error'){

                    this.error = this.getterLoginMessage

                    this.errors = this.getterLoginErrors

                    this.loading = false
                }
            }
        },
        mounted(){
            this.show();
        }
    };
</script>

<style> 
.input-btn {
    width: 100%;
    height: 50px; 
    border: 1px solid #ccc;
    border-radius: 5px;
    display: flex;
    overflow: hidden;
  }
  
  .input-img {
    position: relative;
    width: 80%;
    height: 100%;
  }
  
  .input-img input {
    width: 100%;
    height: 100%;
    outline: none;
    border: none;
    background: none;
    font-size: 25px;
    padding: 0 20px;
    font-family: "Ga Maamli";
  }
  
  .input-img img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.6;
  }
  
  .refresh-btn {
    width: 20%;
    height: 100%;
    border: none;
    background: #4070f4;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    transition: 0.3s;
  }
  
  .refresh-btn:hover {
    opacity: 0.9;
  }
  .captcha-text{
    color: #000;
    font-weight:bold;
    font-style: italic;
  }
</style>
