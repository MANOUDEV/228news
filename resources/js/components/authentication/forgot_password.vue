<template>
    <!-- **************** MAIN CONTENT START **************** -->
    <main style="margin-top: -45px; margin-bottom: -35px;">
        <!-- =======================Inner intro START -->
        <div v-if="dataReady == 0">
            <br><br><br> <br><br><br>
            <div class="d-flex justify-content-center mt-3">
                <div class="spinner-border text-success"   role="status">
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
                            <h2 v-if="step === 1">Email de vérification</h2>
                            <h2 v-else-if="step === 2">Code de rénitialisation</h2>
                            <h2 v-else-if="step === 3">Nouveau mot de passe</h2>
                            <!-- Form START -->

                            <form class="mt-2">
                                <div v-if="step === 1">
                                    <div v-if="errorFirst" class="mb-3">
                                        <br>
                                        <div class="alert alert-danger"  role="alert">
                                            {{ errorFirst }}
                                        </div>
                                    </div>
                                    <div class="mb-3" v-if="errorsFirst.email">
                                        <label class="form-label" for="exampleInputEmail1">Votre email</label>
                                        <input type="email" v-model="email" name="email" class="form-control is-invalid" id="exampleInputEmail1" placeholder="Veuillez entrer votre email">
                                        <div id="exampleInputEmail1" v-for="erroremail in errorsFirst.email" :key="erroremail" class="invalid-feedback">
                                            {{ erroremail }}
                                        </div>
                                    </div>
                                    <div class="mb-3" v-else>
                                        <label class="form-label" for="exampleInputEmail1">Votre email</label>
                                        <input type="email" v-model="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Veuillez entrer votre email">
                                    </div>
                                    <!-- Button -->
                                    <div class="row align-items-center">
                                        <div class="col-sm-4">
                                            <button type="button" disabled v-if="loadingVerifyEmail" class="btn btn-success"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                                <span class="sr-only">Loading...</span>  Vérification</button>
                                            <button type="submit"  @click.prevent="submitVerifyEmail" v-else class="btn btn-success">Vérifier</button>
                                        </div>
                                        <div class="col-sm-8 text-sm-end">
                                            <span><a href="/auth/login"><u>Se connecter</u></a></span>
                                        </div>

                                    </div>
                                </div>

                                <div v-else-if="step === 2">
                                    <div v-if="errorTwo" class="mb-3">
                                        <br>
                                        <div class="alert alert-danger"  role="alert">
                                            {{ errorTwo }}
                                        </div>
                                    </div>
                                    <div class="mb-3" v-if="errorsTwo.otp">
                                        <label class="form-label" for="exampleInputOtp1">Votre code de rénitialisation</label>
                                        <input type="text" v-model="otp" name="otp" class="form-control is-invalid" id="exampleInputOtp1" placeholder="Veuillez entrer votre code de vérification">
                                        <div id="exampleInputOtp1" v-for="errorOtp in errorsTwo.otp" :key="errorOtp" class="invalid-feedback">
                                            {{ errorOtp }}
                                        </div>
                                    </div>
                                    <div class="mb-3" v-else>
                                        <label class="form-label" for="exampleInputOtp1">Votre code de rénitialisation</label>
                                        <input type="text"  v-model="otp" name="otp" class="form-control" id="exampleInputOtp1" placeholder="Veuillez entrer votre code de vérification">
                                    </div>
                                    <div class="mb-3" v-if="loadingResendOTP">
                                        <span for="exampleInputOtp1"><span style="color: blue; cursor:pointer">Renvoie d'un nouveau code en cours ... </span></span>
                                    </div>
                                    <div class="mb-3" v-if="!loadingResendOTP">
                                        <span for="exampleInputOtp1" @click.prevent="submitResendOtp"><span style="color: blue; cursor:pointer">Renvoyer un nouveau code </span></span>
                                    </div>
                                    <!-- Button -->
                                    <div class="row align-items-center">
                                        <div class="col-sm-12 justify-content-center" v-if="loadingVerifyOtp">
                                            <button type="button" disabled  class="btn btn-success"> 
                                                <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                                <span class="sr-only">Loading...</span>  Validation
                                            </button>
                                        </div>
                                        <div class="col-sm-12 justify-content-center" v-else>
                                            <span><span class="btn btn-primary" @click="PreviousStep"><i class="bi bi-arrow-left-short"></i> Retour</span></span> &nbsp;
                                            <button type="submit"  @click.prevent="submitVerifyOtp" class="btn btn-success">Valider </button>
                                        </div>
                                    </div>
                                </div>

                                <div v-else-if="step === 3">
                                    <div v-if="errorThree" class="mb-3">
                                        <br>
                                        <div class="alert alert-danger"  role="alert">
                                            {{ errorThree }}
                                        </div>
                                    </div>
                                    <div class="mb-3" v-if="errorsThree.password">
                                        <label class="form-label" for="exampleInputpassword1">Votre nouveau mot de passe</label>
                                        <div class="input-group">
                                            <input v-model="password" name="password" class="form-control fakepassword is-invalid" type="password" id="psw-input" placeholder="Veuillez entrer votre nouveau mot de passe">
                                            <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                                <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                                <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                            </span>
                                        </div>
                                        <div class="rounded mt-1" id="psw-strength"></div>
                                        <div id="exampleInputpassword1" v-for="errorpassword in errorsThree.password" :key="errorpassword" class="invalid-feedback">
                                            {{ errorpassword }}
                                        </div>
                                    </div>
                                    <div class="mb-3" v-else>
                                        <label class="form-label" for="exampleInputpassword1">Votre nouveau mot de passe</label>
                                        <div class="input-group">
                                            <input v-model="password" name="password" class="form-control fakepassword" type="password" id="psw-input" placeholder="Veuillez entrer votre nouveau mot de passe">
                                            <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                                <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                                <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                            </span>
                                        </div>
                                        <div class="rounded mt-1" id="psw-strength"></div>
                                    </div>

                                    <div class="mb-3" v-if="errorsThree.password_confirm">
                                        <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                        <div class="input-group">
                                            <input type="password" v-model="password_confirm" class="form-control fakepassword is-invalid"  name="password_confirm"  id="psw-input_c" placeholder="Veuillez confirmer le mot de passe">
                                            <span class="input-group-text p-0" @click="showPasswordC" style="cursor: pointer">
                                                <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                                <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                            </span>
                                        </div>
                                        <div class="rounded mt-1" id="psw-strength"></div>
                                        <div id="exampleInputpassword1" v-for="errorpassword_confirm in errorsThree.password_confirm" :key="errorpassword_confirm" class="invalid-feedback">
                                            {{ errorpassword_confirm }}
                                        </div>
                                    </div>
                                    <div class="mb-3" v-else>
                                        <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                        <div class="input-group">
                                            <input type="password" v-model="password_confirm" class="form-control fakepassword"  name="password_confirm"  id="psw-input_c" placeholder="Veuillez confirmer le mot de passe">
                                            <span class="input-group-text p-0" @click="showPasswordC" style="cursor: pointer">
                                                <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                                <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                            </span>
                                        </div>
                                        <div class="rounded mt-1" id="psw-strength"></div>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" name="remember_me" v-model="remember_me" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
                                    </div>
                                    <!-- Button -->
                                    <div class="row align-items-center">
                                        <div class="col-sm-12 justify-content-center" v-if="loadingNewPass">
                                            <button type="button" disabled  class="btn btn-success"> 
                                                <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                                <span class="sr-only">Loading...</span>  Enregistrement
                                            </button>
                                        </div>
                                        <div class="col-sm-12 justify-content-center" v-else>
                                            <span><span class="btn btn-primary" @click="PreviousHStep"><i class="bi bi-arrow-left-short"></i> Retour</span></span> &nbsp;
                                            <button type="submit"  @click.prevent="submitNewPass" class="btn btn-success">Enregistrer </button>
                                        </div>
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
</template>
<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        data(){
            return{
                loadingVerifyEmail: false,
                loadingNewPass: false,
                loadingResendOTP: false,
                loadingVerifyOtp: false,
                email:null,
                otp:null,
                password: null,
                password_confirm: null,
                loginError: false,
                loading: false,
                errorFirst: false,
                errorTwo: false,
                errorThree: false,
                errorsFirst: [],
                errorsTwo: [],
                errorsThree: [],
                dataReady: 0,
                step:1,
                meProfileRoleName: null,
                remember_me:false,
                showPsw: false,
                showPswC: false
            }
        },
        computed:{
            ...mapGetters("meProfile",{
                gettersProfileStatus:'getProfileStatus',
                gettersMeProfileRoleName:"getMeProfileRoleName",
            }),

            ...mapGetters("forgot_password",{
                gettersSendOtpForgotPasswordStatus:'getSendOtpForgotPasswordStatus',
                gettersSendOtpForgotPasswordErrors:'getSendOtpForgotPasswordErrors',
                gettersSendOtpForgotPasswordMessage:'getSendOtpForgotPasswordMessage',
                gettersCheckOtpForgotPasswordStatus:'getCheckOtpForgotPasswordStatus',
                gettersCheckOtpForgotPasswordErrors:'getCheckOtpForgotPasswordErrors',
                gettersCheckOtpForgotPasswordMessage:'getCheckOtpForgotPasswordMessage',
                gettersNewPassOtpForgotPasswordStatus:'getNewPassOtpForgotPasswordStatus',
                gettersNewPassOtpForgotPasswordErrors:'getNewPassOtpForgotPasswordErrors',
                gettersNewPassOtpForgotPasswordMessage:'getNewPassOtpForgotPasswordMessage',
            }),
        },
        methods:{

            ...mapActions("forgot_password",{
                actionsSendOtpForgotPassword:'sendOtpForgotPassword',
                actionsCheckOtpForgotPassword:'checkOtpForgotPassword',
                actionsNewPassOtpForgotPassword:'newPassOtpForgotPassword'
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

            showPasswordC(){
                var x = document.getElementById("psw-input_c");
                if (x.type === "password") {
                    x.type = "text";
                    this.showPsw = true
                } else {
                    x.type = "password";
                    this.showPsw = false
                }
            },

            async show(){

                if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                    await this.actionsGetMeProfile();

                    if(this.gettersProfileStatus === 'success'){

                        this.meProfileRoleName = this.gettersMeProfileRoleName

                        this.dataReady = 1


                        if(localStorage.getItem('remember_me') == "true" &&  localStorage.getItem('username') && localStorage.getItem('password')){

                            this.username = localStorage.getItem('username')

                            this.password = localStorage.getItem('password')

                            this.remember_me = localStorage.getItem('remember_me')

                        }

                    }else if(this.gettersProfileStatus === 'failed'){

                        this.dataReady = 2;

                        if(localStorage.getItem('remember_me') == "true" && localStorage.getItem('username') && localStorage.getItem('password')){

                            this.username = localStorage.getItem('username')

                            this.password = localStorage.getItem('password')

                            this.remember_me = localStorage.getItem('remember_me')

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

            async submitVerifyEmail(){
                this.loadingVerifyEmail = true
                this.errorFirst = null
                this.errorsFirst = []
                await this.actionsSendOtpForgotPassword({email:this.email});

                if(this.gettersSendOtpForgotPasswordStatus === 'success'){

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
                        title: this.gettersSendOtpForgotPasswordMessage
                    })

                    this.errorFirst = null
                    this.errorsFirst = []

                    this.loadingVerifyEmail = false

                    this.step = 2

                }else if(this.gettersSendOtpForgotPasswordStatus === 'failed'){

                    this.errorFirst = this.gettersSendOtpForgotPasswordMessage

                    this.errorsFirst = []

                    this.loadingVerifyEmail = false

                }else if(this.gettersSendOtpForgotPasswordStatus === 'error'){

                    this.errorFirst = this.gettersSendOtpForgotPasswordMessage

                    this.errorsFirst = this.gettersSendOtpForgotPasswordErrors

                    this.loadingVerifyEmail = false
                }

                this.loadingVerifyEmail = false
            },

            async submitResendOtp(){
                this.loadingResendOTP = true
                this.errorFirst = null
                this.errorsFirst = []
                await this.actionsSendOtpForgotPassword({email:this.email});

                if(this.gettersSendOtpForgotPasswordStatus === 'success'){

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
                        title: this.gettersSendOtpForgotPasswordMessage
                    })

                    this.errorFirst = null
                    this.errorsFirst = []

                    this.loadingResendOTP = false

                    this.step = 2

                }else if(this.gettersSendOtpForgotPasswordStatus === 'failed'){

                    this.errorFirst = this.gettersSendOtpForgotPasswordMessage

                    this.errorsFirst = []

                    this.loadingResendOTP = false

                }else if(this.gettersSendOtpForgotPasswordStatus === 'error'){

                    this.errorFirst = this.gettersSendOtpForgotPasswordMessage

                    this.errorsFirst = this.gettersSendOtpForgotPasswordErrors

                    this.loadingResendOTP = false
                }

                this.loadingResendOTP = false
            },

            async submitVerifyOtp(){

                this.loadingVerifyOtp = true
                this.errorTwo = null
                this.errorsTwo = []
                await this.actionsCheckOtpForgotPassword({email:this.email, otp :this.otp });

                if(this.gettersCheckOtpForgotPasswordStatus === 'success'){

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
                        title: this.gettersCheckOtpForgotPasswordMessage
                    })

                    this.errorTwo = null
                    this.errorsTwo = []

                    this.loadingVerifyOtp = false

                    this.step = 3

                }else if(this.gettersCheckOtpForgotPasswordStatus === 'failed'){

                    this.errorTwo = this.gettersCheckOtpForgotPasswordMessage

                    this.errorsTwo = []

                    this.loadingVerifyOtp = false

                }else if(this.gettersCheckOtpForgotPasswordStatus === 'error'){

                    this.errorTwo = this.gettersCheckOtpForgotPasswordMessage

                    this.errorsTwo = this.gettersCheckOtpForgotPasswordErrors

                    this.loadingVerifyOtp = false
                }
                this.loadingVerifyOtp = false
            },

            async submitNewPass(){
                this.loadingNewPass = true
                this.errorThree = null
                this.errorsThree = []
                await this.actionsNewPassOtpForgotPassword({email:this.email, otp :this.otp, password :this.password ,password_confirm :this.password_confirm});

                if(this.gettersNewPassOtpForgotPasswordStatus === 'success'){

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
                        title: this.gettersNewPassOtpForgotPasswordMessage
                    })

                    this.errorThree = null
                    this.errorsThree = []

                    if(this.remember_me){

                        localStorage.setItem('password', this.password)

                        localStorage.setItem('remember_me', true)

                         window.location="/auth/login"


                    }else{

                        localStorage.setItem('remember_me', false)

                         window.location="/auth/login"
                    }


                }else if(this.gettersNewPassOtpForgotPasswordStatus === 'failed'){

                    this.errorThree = this.gettersNewPassOtpForgotPasswordMessage

                    this.errorsThree = []

                    this.loadingNewPass = false

                }else if(this.gettersNewPassOtpForgotPasswordStatus === 'error'){

                    this.errorThree = this.gettersNewPassOtpForgotPasswordMessage

                    this.errorsThree = this.gettersNewPassOtpForgotPasswordErrors

                    this.loadingNewPass = false
                }
                this.loadingNewPass = false

            },

            PreviousStep(){
                this.errorFirst = null
                this.errorsFirst = []
                this.errorTwo = null
                this.errorsTwo = []
                this.errorThree = null
                this.errorsThree = []
                this.step = 1
            },

            PreviousHStep(){
                this.errorFirst = null
                this.errorsFirst = []
                this.errorTwo = null
                this.errorsTwo = []
                this.errorThree = null
                this.errorsThree = []
                this.step = 2
            }

        },
        mounted(){
            this.show();
        }
    };
</script>
