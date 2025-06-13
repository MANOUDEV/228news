<template>
    <div class="row">
        <div class="col-12">
            <h2>Contactez-nous</h2>
            <p>Veuillez remplir le formulaire ci-dessous et nous vous contacterons très prochainement ou soit via le canal de nos réseaux sociaux. Votre adresse email ne sera pas publiée.</p>
            <div class="row">
                    <!-- Left sidebar START -->
                <div class="col-md-1">
                    <div class="text-start text-lg-center" >
                        <ul class="nav text-white-force">
                            <li class="nav-item">
                                <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-facebook" href="https://www.facebook.com/Togoactualite-148480121847124" target="_blank">
                                    <i class="fab fa-facebook-square align-middle"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-dark" href="https://x.com/Togoactualite" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-linkedin" href="https://fr.linkedin.com/in/togoactualite-togo-actualit%C3%A9-3a076648" target="_blank">
                                    <i class="fab fa-linkedin align-middle"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-success" href="https://wa.link/qf0v9s" target="_blank">
                                    <i class="fab fa-whatsapp align-middle"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-danger" href="mailto:contact@togoactualite.com" target="_blank">
                                    <i class="far fa-envelope align-middle"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Left sidebar END -->

                <!-- Main Content START -->
                <div class="col-md-11 col-lg-11 mb-1">
                    <div v-if="dataReady == 0">
                        <br><br><br> <br>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="spinner-border text-success"  role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <br><br><br><br><br>
                    </div>
                    <div v-else-if="dataReady == 1">
                        <!-- Form START -->
                        <form class="contact-form" id="contact-form" name="contactform" method="POST">

                            <div v-if="error">
                                <br>
                                <div class="alert alert-danger"  role="alert">
                                    {{ error }}
                                </div>
                            </div>
                            <!-- Main form -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Subject -->
                                    <div class="mb-3" v-if="errors.subject">
                                        <input  id="con-subject" name="subject" v-model="subject" type="text" class="form-control is-invalid" placeholder="Votre requête">
                                        <div id="exampleInputPassword1" v-for="errorSubject in errors.subject" :key="errorSubject" class="invalid-feedback">
                                            {{ errorSubject }}
                                        </div>
                                    </div>
                                     <div class="mb-3" v-else>
                                        <input  id="con-subject" name="subject" v-model="subject" type="text" class="form-control" placeholder="Votre requête">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- Message -->
                                    <div class="mb-3" v-if="errors.content">
                                        <QuillEditor theme="snow" v-model:content="content" placeholder='Redigez le contenu de votre requête!' style=" min-height: 100px;" contentType="html" />
                                        <div id="exampleInputPassword1" v-for="errorContent in errors.content" :key="errorContent" class="invalid-feedback">
                                            {{ errorContent }}
                                        </div>
                                    </div>
                                    <div class="mb-3" v-else>
                                        <QuillEditor theme="snow" v-model:content="content" placeholder='Redigez le contenu de votre requête!' style=" min-height: 100px;" contentType="html" />
                                        
                                    </div>
                                </div>
                            <!-- submit button -->
                                <div class="col-md-12 text-start">
                                    <button @click.prevent="saveNewsletter" v-if="!loading" class="btn btn-primary w-100"  >Envoyer le message </button>
                                    <button type="button" disabled v-else class="btn btn-primary w-100">
                                        <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                        <span class="sr-only">Loading...</span>  Envoie en cours ...
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Form END -->
                    </div>

                    <div v-else-if="dataReady == 2">

                        <div v-if="error">
                            <br>
                            <div class="alert alert-danger"  role="alert">
                                {{ error }}
                            </div>
                        </div>
                        <!-- Form START -->
                        <form class="contact-form" >
                            <!-- Main form -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                    <!-- Nom Complet -->
                                    <div class="mb-3" v-if="errors.nom_complet">
                                        <input  id="con-nom_complet" name="nom_complet" v-model="nom_complet" type="text" class="form-control is-invalid" placeholder="Votre nom complet">
                                        <div id="exampleInputPassword1" v-for="errornom_complet in errors.nom_complet" :key="errornom_complet" class="invalid-feedback">
                                            {{ errornom_complet }}
                                        </div>
                                    </div>
                                     <div class="mb-3" v-else>
                                     <input  id="con-nom_complet" name="nom_complet" v-model="nom_complet" type="text" class="form-control" placeholder="Votre nom complet">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3" v-if="errors.email">
                                        <input  id="con-email" name="email" v-model="email" type="email" class="form-control is-invalid" placeholder="Votre email">
                                        <div id="exampleInputPassword1" v-for="errorEmail in errors.email" :key="errorEmail" class="invalid-feedback">
                                            {{ errorEmail }}
                                        </div>
                                    </div>
                                    <div class="mb-3" v-else>
                                      <input  id="con-email" name="email" v-model="email" type="email" class="form-control" placeholder="Votre email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- Subject -->
                                    <div class="mb-3" v-if="errors.subject">
                                        <input  id="con-subject" name="subject" v-model="subject" type="text" class="form-control is-invalid" placeholder="Votre requête">
                                        <div id="exampleInputPassword1" v-for="errorSubject in errors.subject" :key="errorSubject" class="invalid-feedback">
                                            {{ errorSubject }}
                                        </div>
                                    </div>
                                     <div class="mb-3" v-else>
                                        <input  id="con-subject" name="subject" v-model="subject" type="text" class="form-control" placeholder="Votre requête">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- Message -->
                                    <div class="mb-3" v-if="errors.content">
                                        <QuillEditor theme="snow" v-model:content="content" placeholder='Redigez le contenu de votre requête!' style=" min-height: 100px;" contentType="html" />
                                        <div id="exampleInputPassword1" v-for="errorContent in errors.content" :key="errorContent" class="invalid-feedback">
                                            {{ errorContent }}
                                        </div>
                                    </div>
                                    <div class="mb-3" v-else>
                                        <QuillEditor theme="snow" v-model:content="content" placeholder='Redigez le contenu de votre requête!' style=" min-height: 100px;" contentType="html" />
                                        
                                    </div>
                                </div>
                            <!-- submit button -->
                                <div class="col-md-12 text-start">
                                    <button @click.prevent="saveNewsletter" v-if="!loading" class="btn btn-primary w-100"  >Envoyer le message </button>
                                    <button type="button" disabled v-else class="btn btn-primary w-100">
                                        <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                        <span class="sr-only">Loading...</span>  Envoie en cours ...
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Form END -->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="verifyCaptchaContact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title">Vérification CAPTCHA</h5>
                    <button type="button" class="btn-close" @click="verifyCaptchaContactClose" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <button v-if="authState == 2" class="refresh-btn" @click="save">
                              <i class="fas fa-arrow-right"></i>
                            </button>
                            <button v-else-if="authState == 1" class="refresh-btn" @click="saveAuth">
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
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
  
export default {

    components: {
        QuillEditor 
    },
    data(){
        return{
            nom_complet:null,
            email: null,
            subject: null,
            content: null,
            error: false,
            errors: {},
            dataReady: 0,
            loading:false,
            captchaRandomNumber: null,
            captchaRandomVerify: null,
            messageCaptcha:null,
            authState: false,
        }
    },
    computed:{

        ...mapGetters("meProfile",{
            gettersProfileStatus:'getMeProfileStatus',
            gettersMeProfileRoleName:"getMeProfileRoleName",
        }),

        ...mapGetters('contact',{
            getterContactStatus:'getContactStatus',
            getterContactMessage:'getContactMessage',
            getterContactErrors:'getContactErrors',
            getterContactAuthStatus:'getContactAuthStatus',
            getterContactAuthMessage:'getContactAuthMessage',
            getterContactAuthErrors:'getContactAuthErrors',
        }),

    },
    methods:{
        ...mapActions('contact',{
            actionContact:'contact',
            actionContactAuth:'contactAuth'
        }),

        ...mapActions("meProfile",{
            actionsGetMeProfile:'getMeProfile'
        }),

        verifyCaptchaContactClose(){ 
            this.generateCaptcha()
            this.messageCaptcha = null
            this.captchaRandomVerify = null
            $('#verifyCaptchaContact').modal('hide');
        },

        verifyCaptchaContactShow(){ 
            this.generateCaptcha()
            $('#verifyCaptchaContact').modal('show');
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
            this.verifyCaptchaContactShow() 
        },

        save(){
            if(this.captchaRandomVerify != this.captchaRandomNumber){

                this.messageCaptcha="Veuillez entrer un captcha valide."

            }else{
                this.verifyCaptchaContactClose()
                this.submitSubject()
            }
        },

        saveAuth(){
            if(this.captchaRandomVerify != this.captchaRandomNumber){

                this.messageCaptcha="Veuillez entrer un captcha valide."

            }else{
                this.verifyCaptchaContactClose()
                this.submitSubjectAuth()
            }
        },

        async show(){

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeProfile();

                if(this.gettersProfileStatus === 'success'){

                    this.dataReady = 1

                    this.authState = 1


                }else if(this.gettersProfileStatus === 'failed'){

                    this.dataReady = 2;

                    this.authState = 2

                }

            }else{

                this.dataReady = 2;
                this.authState = 2

            }
        },

        async submitSubject(){

            this.loading = true

            this.error = false

            this.errors = []

            await this.actionContact({nom_complet:this.nom_complet, email:this.email, subject: this.subject, content: this.content});

            if(this.getterContactStatus === 'success'){

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
                    title: this.getterContactMessage
                })

                this.loading = false

                this.nom_complet = null

                this.email = null

                this.subject = null

                this.content = null

                this.error = false

                this.errors = []

            }else if(this.getterContactStatus === 'failed'){

                this.error = this.getterContactMessage

                this.errors = []

                this.loading = false

            }else if(this.getterContactStatus === 'error'){


                this.error = this.getterContactMessage

                this.errors = this.getterContactErrors

                this.loading = false
            }

        },

        async submitSubjectAuth(){

            this.loading = true

            this.error = false

            this.errors = []

            await this.actionContactAuth({subject: this.subject, content: this.content});

            if(this.getterContactAuthStatus === 'success'){

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
                    title: this.getterContactAuthMessage
                })

                this.loading = false

                this.nom_complet = null

                this.email = null

                this.subject = null

                this.content = null

                this.error = false

                this.errors = []

            }else if(this.getterContactAuthStatus === 'failed'){

                this.error = this.getterContactAuthMessage

                this.errors = []

                this.loading = false

            }else if(this.getterContactAuthStatus === 'error'){

                this.error = this.getterContactAuthMessage

                this.errors = this.getterContactAuthErrors

                this.loading = false
            }

        }
    },
    mounted(){
        this.show();
    }
}

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
