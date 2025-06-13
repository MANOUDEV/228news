<template>
    <section class="py-4">
        <div class="container">

                <!-- Author list title START -->
                <div class="row g-4 pb-4">
                    <div class="col-12">
                        <!-- Title -->
                        <div class="d-sm-flex justify-content-sm-between align-items-center">
                            <h1 class="mb-2 mb-sm-0 h2">Ajouter un auteur </h1>
                            <router-link style="cursor: pointer" :to="{'name': 'admin.authors'}" class="btn btn-sm btn-primary mb-0"><i class="fas fa-eye me-2"></i>Voir les auteurs</router-link>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <!-- Left sidebar START -->
                    <div class="col-lg-12 col-xxl-8">
                      <!-- Profile START -->
                      <div class="card border mb-4">
                        <div class="card-header border-bottom p-3">
                          <h5 class="card-header-title mb-0">Ajouter un auteur</h5>
                        </div>
                        <div class="card-body">
                        <div v-if="authorsStoreMessage">
                            <div class="alert alert-danger"  role="alert">
                                {{ authorsStoreMessage }}
                            </div>
                        </div>
                        <form>
                          <!-- Full name -->
                          <div class="mb-3"  v-if="authorsStoreErrors.nom || authorsStoreErrors.prenoms">
                            <label class="form-label">Nom Complet <sup class="text-danger">*</sup></label>
                            <div class="input-group">
                              <input type="text" class="form-control is-invalid" v-model="nom" name="nom" placeholder="Entrez votre nom">
                              <input type="text" class="form-control is-invalid" v-model="prenoms"  name="prenoms" placeholder="Entrez votre prénom">
                            </div>
                            <div v-for="errornom in authorsStoreErrors.nom" :key="errornom" class="text-danger">
                                {{ errornom }}
                            </div>
                            <div v-for="errorprenoms in authorsStoreErrors.prenoms" :key="errorprenoms" class="text-danger">
                                {{ errorprenoms }}
                            </div>
                          </div>
                          <div class="mb-3" v-else>
                            <label class="form-label">Nom Complet <sup class="text-danger">*</sup></label>
                            <div class="input-group">
                              <input type="text" class="form-control" v-model="nom" name="nom" placeholder="Entrez votre nom">
                              <input type="text" class="form-control" v-model="prenoms"  name="prenoms" placeholder="Entrez votre prénom">
                            </div>
                          </div>
                          <!-- Username -->
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="mb-3" v-if="authorsStoreErrors.authorName">
                                <label class="form-label">Nom d'auteur</label>
                                <div class="input-group">
                                  <span class="input-group-text">togoactualite.com/auteurs/</span>
                                  <input type="text" class="form-control is-invalid" v-model="authorName" name="authorName" placeholder="Entrez votre nom d'auteur">
                                </div>
                                <div v-for="errorname in authorsStoreErrors.authorName" :key="errorname" class="text-danger">
                                    {{ errorname }}
                                </div>
                              </div>
                              <div class="mb-3" v-else>
                                <label class="form-label">Nom d'auteur</label>
                                <div class="input-group">
                                  <span class="input-group-text">togoactualite.com/auteurs/</span>
                                  <input type="text" class="form-control" name="authorName" v-model="authorName" placeholder="Entrez votre nom d'auteur">
                                </div>
                                <div class="form-text">Par defaut le nom d'auteur sera son prénom.</div>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3" v-if="authorsStoreErrors.email">
                                    <label class="form-label">Email <sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                        <input type="email" class="form-control is-invalid" name="email" v-model="email" placeholder="Entrez votre email">
                                    </div>
                                    <div v-for="erroremail in authorsStoreErrors.email" :key="erroremail" class="text-danger">
                                        {{ erroremail }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label">Email <sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" v-model="email" placeholder="Entrez votre email">
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3" v-if="authorsStoreErrors.telephone">
                                    <label class="form-label">Télephone</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control is-invalid" name="telephone" v-model="telephone" placeholder="Entrez votre télephone">
                                    </div>
                                    <div v-for="errortelephone in authorsStoreErrors.telephone" :key="errortelephone" class="text-danger">
                                        {{ errortelephone }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label">Télephone</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="telephone" v-model="telephone" placeholder="Entrez votre télephone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3" v-if="authorsStoreErrors.address">
                                    <label class="form-label">Adresse</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control is-invalid" name="address" v-model="address" placeholder="Entrez votre Adresse">
                                    </div>
                                    <div v-for="erroraddress in authorsStoreErrors.address" :key="erroraddress" class="text-danger">
                                        {{ erroraddress }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label">Adresse</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="address" v-model="address" placeholder="Entrez votre Adresse">
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="mb-3" v-if="authorsStoreErrors.description">
                                <label class="form-label">Description</label>
                                <QuillEditor theme="snow" v-model:content="description" placeholder='Redigez le contenu de votre description!' style=" min-height: 100px;" contentType="html" />
                                <div v-for="errordescription in authorsStoreErrors.description" :key="errordescription" class="text-danger">
                                    {{ errordescription }}
                                </div>
                              </div>
                              <div class="mb-3" v-else>
                                <label class="form-label">Description</label>
                                <QuillEditor theme="snow" v-model:content="description" placeholder='Redigez le contenu de votre description!' style=" min-height: 100px;" contentType="html" />
                                <div class="form-text">Une brève description pour le profil de l'auteur.</div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex justify-content-end mt-4" v-if="!loadingCreate">
                            <button type="button" @click="cancel" class="btn btn-danger border-0 me-2">Annuler</button>
                            <button type="submit" @click="create" class="btn btn-primary">Enregistrer</button>
                          </div>
                          <div class="d-flex justify-content-end mt-4" v-else>
                            <button type="button" disabled class="btn btn-success border-0 me-2">
                                <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                <span class="sr-only">Loading...</span>Enregistrement...</button>
                          </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!-- Modal Form -->
     <div class="modal fade" id="authFormModalAuthorsCreateAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">


            <!-- Login Form -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="authSectionStepModal == 1">Se connecter</h5>
                    <h5 class="modal-title" v-else-if="authSectionStepModal == 2">Modifier le mot de passe</h5>
                    <h5 class="modal-title" v-else-if="authSectionStepModal == 3">S'inscrire</h5>
                    <button type="button" class="btn-close" @click="authFormModalAuthorsCreateAdminClose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div v-if="authSectionStepModal == 1" style="margin-bottom: -15px">
                        <div v-if="errorLogin">
                            <div class="alert alert-danger"  role="alert">
                                {{ errorLogin }}
                            </div>
                        </div>
                        <form>
                            <!-- Email -->
                            <div class="mb-3" v-if="errorsLogin.username">
                                <label class="form-label" for="exampleInputEmailLogin">Nom d'utilisateur ou email</label>
                                <input type="text" v-model="username" name="username" class="form-control is-invalid" id="exampleInputEmailLogin" placeholder="Votre nom d'utilisateur ou votre email">
                                <div v-for="errorUsername in errorsLogin.username" :key="errorUsername" class="invalid-feedback">
                                    {{ errorUsername }}
                                </div>
                            </div>
                            <div class="mb-3" v-else>
                                <label class="form-label" for="exampleInputEmailLoginInvalid">Nom d'utilisateur ou email</label>
                                <input type="text" v-model="username" name="username" class="form-control" id="exampleInputEmailLoginInvalid" placeholder="Votre nom d'utilisateur ou votre email">
                            </div>
                            <!-- Password -->
                            <div class="mb-3" v-if="errorsLogin.password">
                                <label class="form-label" for="exampleInputPasswordLogin">Mot de passe</label>
                                <div class="input-group">
                                    <input v-model="password" name="password" class="form-control fakepassword is-invalid" type="password" id="psw-input" placeholder="*********">
                                    <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                        <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                        <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                    </span>
                                </div>
                                <div class="rounded mt-1" id="psw-strength"></div>
                                <div  v-for="errorPassword in errorsLogin.password" :key="errorPassword" class="invalid-feedback">
                                    {{ errorPassword }}
                                </div>
                            </div>
                            <div class="mb-3" v-else>
                                <label class="form-label"  for="exampleInputPasswordLoginInvalid">Mot de passe</label>
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

                            <button type="button" disabled v-if="loadingLogin" class="btn btn-success mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                <span class="sr-only">Loading...</span>  Connexion</button>
                            <button type="submit"  @click.prevent="submitLogin" v-else class="btn btn-success mx-auto w-100">Se connecter</button>

                        </form>

                    </div>
                    <div  v-if="authSectionStepModal == 2" style="margin-bottom: -15px">
                        <h6 v-if="step === 1">Email de vérification</h6>
                        <h6 v-else-if="step === 2">Code de rénitialisation</h6>
                        <h6 v-else-if="step === 3">Nouveau mot de passe</h6>

                        <div v-if="step === 1">
                            <div v-if="errorForgotPasswordFirst" class="mb-3">
                                <div class="alert alert-danger"  role="alert">
                                    {{ errorForgotPasswordFirst }}
                                </div>
                            </div>
                            <form >
                                <div class="mb-3" v-if="errorsForgotPasswordFirst.email">
                                    <input type="email" v-model="email" name="email" class="form-control is-invalid" id="exampleInputEmail1" placeholder="Veuillez entrer votre email">
                                    <div v-for="errorForgotPasswordemail in errorsForgotPasswordFirst.email" :key="errorForgotPasswordemail" class="invalid-feedback">
                                        {{ errorForgotPasswordemail }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <input type="email" v-model="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Veuillez entrer votre email">
                                </div>
                                <!-- Button -->
                                <button type="button" disabled v-if="loadingForgotPasswordFirst" class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                    <span class="sr-only">Loading...</span>Vérification</button>
                                <button type="submit" @click.prevent="submitVerifyForgotPasswordEmail" v-else class="btn btn-success  mx-auto w-100">Vérifier</button>
                            </form>
                        </div>
                        <div v-if="step === 2">
                            <div v-if="errorForgotPasswordTwo" class="mb-3">

                                <div class="alert alert-danger"  role="alert">
                                    {{ errorForgotPasswordTwo }}
                                </div>
                            </div>
                            <form>
                                <div class="mb-3" v-if="errorsForgotPasswordTwo.otp">

                                    <input type="text" v-model="otp" name="otp" class="form-control is-invalid" id="exampleInputOtp1" placeholder="Veuillez entrer votre code de vérification">
                                    <div v-for="errorForgotPasswordOtp in errorsForgotPasswordTwo.otp" :key="errorForgotPasswordOtp" class="invalid-feedback">
                                        {{ errorForgotPasswordOtp }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>

                                    <input type="text"  v-model="otp" name="otp" class="form-control" id="exampleInputOtp1" placeholder="Veuillez entrer votre code de vérification">
                                </div>
                                <div class="mb-3" v-if="loadingResendOTP">
                                    <span for="exampleInputOtp1"><span style="color: blue; cursor:pointer">Renvoie d'un nouveau code en cours ... </span></span>
                                </div>
                                <div class="mb-3" v-if="!loadingResendOTP">
                                    <span for="exampleInputOtp1" @click.prevent="submitResendOtp"><span style="color: blue; cursor:pointer">Renvoyer un nouveau code </span></span>
                                </div>
                                <div class="row" v-if="loadingForgotPasswordTwo">
                                    <div class="col-md-12">
                                        <button type="button" disabled class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                            <span class="sr-only">Loading...</span>Validation
                                        </button>
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-md-6">
                                        <span><span class="btn btn-primary  mx-auto w-100" @click="PreviousForgotPasswordStep"><i class="bi bi-arrow-left-short"></i>Retour</span></span>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" @click.prevent="submitVerifyForgotPasswordOtp" class="btn btn-success  mx-auto w-100">Valider</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-if="step === 3">
                            <div v-if="errorForgotPasswordThree" class="mb-3">
                                <div class="alert alert-danger"  role="alert">
                                    {{ errorForgotPasswordThree }}
                                </div>
                            </div>
                            <form>
                                <div class="mb-3" v-if="errorsForgotPasswordThree.password">
                                    <label class="form-label" for="exampleInputpassword1">Votre nouveau mot de passe</label>
                                    <div class="input-group">
                                        <input v-model="password" name="password" class="form-control fakepassword is-invalid" type="password" id="psw-input" placeholder="Veuillez entrer votre nouveau mot de passe .">
                                        <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                            <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                    <div v-for="errorForgotPasswordpassword in errorsForgotPasswordThree.password" :key="errorForgotPasswordpassword" class="invalid-feedback">
                                        {{ errorForgotPasswordpassword }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Votre nouveau mot de passe</label>
                                    <div class="input-group">
                                        <input v-model="password" name="password" class="form-control fakepassword" type="password" id="psw-input" placeholder="Veuillez entrer votre nouveau mot de passe .">
                                        <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                            <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                </div>

                                <div class="mb-3" v-if="errorsForgotPasswordThree.password_confirm">
                                    <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                    <div class="input-group">
                                        <input type="password" v-model="password_confirm" class="form-control fakepassword is-invalid"  name="password_confirm"  id="psw-input_c" placeholder="Veuillez confirmer le mot de passe">
                                        <span class="input-group-text p-0" @click="showPasswordC" style="cursor: pointer">
                                            <i v-if="showPswC == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                    <div v-for="errorForgotPasswordpassword_confirm in errorsForgotPasswordThree.password_confirm" :key="errorForgotPasswordpassword_confirm" class="invalid-feedback">
                                        {{ errorForgotPasswordpassword_confirm }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                    <div class="input-group">
                                        <input type="password" v-model="password_confirm" class="form-control fakepassword "  name="password_confirm"  id="psw-input_c" placeholder="Veuillez confirmer le mot de passe">
                                        <span class="input-group-text p-0" @click="showPasswordC" style="cursor: pointer">
                                            <i v-if="showPswC == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                </div>
                                <div class="row" v-if="loadingForgotPasswordThree">
                                    <div class="col-md-12">
                                        <button type="button" disabled class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                            <span class="sr-only">Loading...</span>Modification
                                        </button>
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-md-6">
                                        <span><span class="btn btn-primary  mx-auto w-100" @click="PreviousHForgotPasswordStep"><i class="bi bi-arrow-left-short"></i>Retour</span></span>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" @click.prevent="submitForgotPasswordNewPass" class="btn btn-success  mx-auto w-100">Modifier</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                </div>
                <div v-if="authSectionStepModal == 2" style="margin-top: -15px">
                    <p class="text-center"><span @click="changeAuthSectionStepModalToLogin" style="cursor: pointer; color: blue"> Se connecter</span></p>
                </div>
                <div v-else-if="authSectionStepModal == 1" style="margin-top: -15px">
                    <p class="text-center"><span @click="changeAuthSectionStepModalToForgotPassword" style="cursor: pointer; color: blue"> Mot de passe oublié ?</span></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions} from "vuex";
import {Bootstrap5Pagination, TailwindPagination } from '../../../../../libraries/pagination/lib';
import moment from 'moment'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {

    components: {
        QuillEditor, 
        Bootstrap5Pagination,
        TailwindPagination,
    },
    data () {
        return {
            dataReady: 0,
            meRoleName: null,
            authorsStoreData: {},
            authorsStoreMessage: null,
            authorsStoreErrors: [],
            style: 'bootstrap5',
            limit: 1,
            keepLength: false,
            showDisabled: false,
            size: 'default',
            align: 'left',
            search: '',
            meProfileUserName: null,
            meProfileRoleName: null,
            authSectionModal: 'LIST',
            username: null,
            password: null,
            password_confirm: null,
            loadingLogin: false,
            errorLogin: false,
            errorsLogin: [],
            loadingConnect: false,
            remember_me: false,
            authSectionStepModal: 1,
            loadingForgotPasswordFirst: false,
            loadingResendOTP: false,
            errorForgotPasswordFirst: false,
            errorsForgotPasswordFirst: [],
            loadingForgotPasswordTwo: false,
            errorForgotPasswordTwo: false,
            errorsForgotPasswordTwo: [],
            loadingForgotPasswordThree: false,
            errorForgotPasswordThree: false,
            errorsForgotPasswordThree: [],
            step: 1,
            nom: null,
            prenoms: null,
            authorName: null,
            email:null,
            telephone:null,
            address:null,
            description: "Nous tenons à rappeler aux visiteurs du site que sans partenariat avec togoactualite.com, la reprise des articles même partielle est strictement interdite.Tout contrevenant s'expose à de graves poursuites.",
            slug: null,
            loadingCreate: false,
            showPsw: false,
            showPswC: false
        }
    },
    computed: {
        ...mapGetters("roleSecurity",{
            gettersMeRoleName:"getMeRoleName",
            gettersRoleStatus:'getRoleStatus',
        }),

        ...mapGetters('authorsAdmin',{
            getterInfosAuthorsStoreStatus:'getInfosAuthorsStoreStatus',
            getterInfosAuthorsStoreMessage:'getInfosAuthorsStoreMessage',
            getterInfosAuthorsStoreErrors:'getInfosAuthorsStoreErrors',
            getterInfosAuthorsStoreData:'getInfosAuthorsStoreData',
        }),
        ...mapGetters('login',{
            getterLoginStatus:'getLoginStatus',
            getterLoginMessage:'getLoginMessage',
            getterLoginErrors:'getLoginErrors',
        }),

        ...mapGetters("meProfile",{
            gettersMeProfileUserName:"getMeProfileUserName",
            gettersMeProfileRoleName:"getMeProfileRoleName",
            gettersProfileStatus:'getProfileStatus',
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

        ...mapActions('login',{
            actionLogin:'login'
        }),

        ...mapActions("meProfile",{
            actionsGetMeProfile:'getMeProfile'
        }),

        ...mapActions("forgot_password",{
            actionsSendOtpForgotPassword:'sendOtpForgotPassword',
            actionsCheckOtpForgotPassword:'checkOtpForgotPassword',
            actionsNewPassOtpForgotPassword:'newPassOtpForgotPassword'
        }),

        ...mapActions("register",{
            actionsSendOtpRegister:'sendOtpRegister',
            actionsCheckOtpRegister:'checkOtpRegister',
            actionsNewInfoOtpRegister:'newInfoOtpRegister',
            actionsNewPassOtpRegister:'newPassOtpRegister'
        }),

        ...mapActions("roleSecurity",{
          actionsGetMeRole:'getMeRole'
        }),

        ...mapActions("authorsAdmin",{
          actionsAuthorsStoreDataRequest:'authorsStoreDataRequest',
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
                this.showPswC = true
            } else {
                x.type = "password";
                this.showPswC = false
            }
        },

        authFormModalAuthorsCreateAdminClose(){
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.authorsStoreMessage =  null
            this.authorsStoreErrors = []
            $('#authFormModalAuthorsCreateAdmin').modal('hide');
        },


        authFormModalAuthorsCreateAdminShow(){

            if(localStorage.getItem('remember_me') == "true" && localStorage.getItem('username') && localStorage.getItem('password')){

                this.username = localStorage.getItem('username')

                this.password = localStorage.getItem('password')

                this.remember_me = localStorage.getItem('remember_me')
            }

            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []

            this.loadingCreate = false

            $('#authFormModalAuthorsCreateAdmin').modal('show');
        },

        cancel(){
            this.nom = null

            this.prenoms = null

            this.authorName = null

            this.email = null

            this.telephone = null

            this.address = null

            this.description = "Nous tenons à rappeler aux visiteurs du site que sans partenariat avec togoactualite.com, la reprise des articles même partielle est strictement interdite.Tout contrevenant s'expose à de graves poursuites."

            this.slug= null

            this.authorsStoreMessage =  null
            this.authorsStoreErrors = []
        },

        PreviousForgotPasswordStep(){
            this.step = 1
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.authorsStoreMessage =  null
            this.authorsStoreErrors = []
        },

        PreviousHForgotPasswordStep(){
            this.step = 2
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.authorsStoreMessage =  null
            this.authorsStoreErrors = []
        },

        changeAuthSectionStepModalToForgotPassword(){
            this.authSectionStepModal = 2
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.authorsStoreMessage =  null
            this.authorsStoreErrors = []
        },

        changeAuthSectionStepModalToLogin(){
            this.authSectionStepModal = 1
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.authorsStoreMessage =  null
            this.authorsStoreErrors = []
        },

        async submitVerifyForgotPasswordEmail(){
            this.loadingForgotPasswordFirst = true
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
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

                this.errorForgotPasswordFirst = null
                this.errorsForgotPasswordFirst = []

                this.loadingForgotPasswordFirst = false

                this.step = 2

            }else if(this.gettersSendOtpForgotPasswordStatus === 'failed'){

                this.errorsForgotPasswordFirst = this.gettersSendOtpForgotPasswordMessage

                this.errorsForgotPasswordFirst = []

                this.loadingForgotPasswordFirst = false

            }else if(this.gettersSendOtpForgotPasswordStatus === 'error'){

                this.errorForgotPasswordFirst = this.gettersSendOtpForgotPasswordMessage

                this.errorsForgotPasswordFirst = this.gettersSendOtpForgotPasswordErrors

                this.loadingForgotPasswordFirst = false
            }

            this.loadingForgotPasswordFirst = false
        },

        async submitResendOtp(){
                this.loadingResendOTP = true
                this.errorForgotPasswordFirst = null
                this.errorsForgotPasswordFirst = []
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

                    this.errorForgotPasswordFirst = null
                    this.errorsForgotPasswordFirst = []

                    this.loadingResendOTP = false

                    this.step = 2

                }else if(this.gettersSendOtpForgotPasswordStatus === 'failed'){

                    this.errorForgotPasswordFirst = this.gettersSendOtpForgotPasswordMessage

                    this.errorsForgotPasswordFirst = []

                    this.loadingResendOTP = false

                }else if(this.gettersSendOtpForgotPasswordStatus === 'error'){

                    this.errorForgotPasswordFirst = this.gettersSendOtpForgotPasswordMessage

                    this.errorsForgotPasswordFirst = this.gettersSendOtpForgotPasswordErrors

                    this.loadingResendOTP = false
                }

                this.loadingResendOTP = false
            },

        async submitVerifyForgotPasswordOtp(){
            this.loadingForgotPasswordTwo = true
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
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

                this.errorForgotPasswordTwo = null
                this.errorsForgotPasswordTwo = []

                this.loadingForgotPasswordTwo = false

                this.step = 3

            }else if(this.gettersCheckOtpForgotPasswordStatus === 'failed'){

                this.errorForgotPasswordTwo = this.gettersCheckOtpForgotPasswordMessage

                this.errorsForgotPasswordTwo = []

                this.loadingForgotPasswordTwo = false

            }else if(this.gettersCheckOtpForgotPasswordStatus === 'error'){

                this.errorForgotPasswordTwo = this.gettersCheckOtpForgotPasswordMessage

                this.errorsForgotPasswordTwo = this.gettersCheckOtpForgotPasswordErrors

                this.loadingForgotPasswordTwo = false
            }
            this.loadingForgotPasswordTwo = false
        },

        async submitForgotPasswordNewPass(){
            this.loadingForgotPasswordThree = true
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
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

                this.errorForgotPasswordThree = null
                this.errorsForgotPasswordThree = []

                this.authSectionStepModal = 1

            }else if(this.gettersNewPassOtpForgotPasswordStatus === 'failed'){

                this.errorForgotPasswordThree = this.gettersNewPassOtpForgotPasswordMessage

                this.errorsForgotPasswordThree = []

                this.loadingForgotPasswordThree = false

            }else if(this.gettersNewPassOtpForgotPasswordStatus === 'error'){

                this.errorForgotPasswordThree = this.gettersNewPassOtpForgotPasswordMessage

                this.errorsForgotPasswordThree = this.gettersNewPassOtpForgotPasswordErrors

                this.loadingForgotPasswordThree = false
            }
            this.loadingForgotPasswordThree = false

        },

        async submitLogin(){
            this.loadingLogin = true
            this.errorLogin = false
            this.errorsLogin = []
            await this.actionLogin({username:this.username, password:this.password, remember_me: this.remember_me});

            if(this.getterLoginStatus === 'success admin'){

                this.errorsLogin = []

                this.errorLogin = false

                if(this.remember_me){

                    localStorage.setItem('username', this.username )

                    localStorage.setItem('password', this.password)

                    localStorage.setItem('remember_me', true)

                    this.loadingLogin = false

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

                    this.authFormModalAuthorsCreateAdminClose()

                    this.loadingCreate = true

                    this.authorsCreate()

                }else{

                    localStorage.setItem('remember_me', false)

                    this.loadingLogin = false

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

                    this.authFormModalAuthorsCreateAdminClose()

                    this.loadingCreate = true

                    this.authorsCreate()

                }

            }else if(this.getterLoginStatus === 'success pub'){

                if(this.remember_me){

                    localStorage.setItem('username', this.username )

                    localStorage.setItem('password', this.password)

                    localStorage.setItem('remember_me', true)

                    this.loadingLogin = false

                    window.location = '/pub/dashboard'


                }else{

                    localStorage.setItem('remember_me', false)

                    this.loadingLogin = false

                    window.location = '/pub/dashboard'
                }



            }else if(this.getterLoginStatus === 'success visitor'){

                if(this.remember_me){

                    localStorage.setItem('username', this.username )

                    localStorage.setItem('password', this.password)

                    localStorage.setItem('remember_me', true)

                    this.loadingLogin = false

                    window.location = '/'


                }else{

                    localStorage.setItem('remember_me', false)

                    this.loadingLogin = false

                    window.location = '/'
                }



            }else if(this.getterLoginStatus === 'failed'){

                this.errorLogin = this.getterLoginMessage

                this.errorsLogin = []

                this.loadingLogin = false

            }else if(this.getterLoginStatus === 'error'){

                this.errorLogin = this.getterLoginMessage

                this.errorsLogin = this.getterLoginErrors

                this.loadingLogin = false
            }
        },

        async create(){

            this.loadingCreate = true

            this.authSectionModal= 'CREATE'

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeRole();

                if(this.gettersRoleStatus === 'success'){

                    this.meRoleName = this.gettersMeRoleName

                    if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbtsd!?')){

                        this.authorsCreate()

                    }else{

                        this.authFormModalAuthorsCreateAdminShow()

                    }

                }else if(this.gettersRoleStatus === 'failed'){

                    this.authFormModalAuthorsCreateAdminShow()
                }

            }else{

                this.authFormModalAuthorsCreateAdminShow()

            }

        },

        async authorsCreate(){

            this.loadingCreate = true

            this.authSectionModal= 'CREATE'

            this.authorsStoreMessage =  null
            this.authorsStoreErrors = []

            await this.actionsAuthorsStoreDataRequest({ nom : this.nom, prenoms : this.prenoms, authorName : this.authorName, email : this.email, address : this.address, telephone : this.telephone, description : this.description});

            if( this.getterInfosAuthorsStoreStatus ==="success"){

                this.authorsStoreData = this.getterInfosAuthorsStoreData

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
                    title: this.getterInfosAuthorsStoreMessage
                })

                this.loadingCreate = false

                this.nom = null

                this.prenoms = null

                this.authorName = null

                this.email = null

                this.telephone = null

                this.address = null

                this.description = "Nous tenons à rappeler aux visiteurs du site que sans partenariat avec togoactualite.com, la reprise des articles même partielle est strictement interdite.Tout contrevenant s'expose à de graves poursuites."

                this.slug= null

                this.authorsStoreMessage =  null
                this.authorsStoreErrors = []

            }else if( this.getterInfosAuthorsStoreStatus ==="empty"){

                this.authorsStoreMessage = this.getterInfosAuthorsStoreMessage

                this.authorsStoreErrors = this.getterInfosAuthorsStoreErrors

                this.loadingCreate = false


            }else if( this.getterInfosAuthorsStoreStatus ==="error"){

                this.authorsStoreMessage = this.getterInfosAuthorsStoreMessage

                this.authorsStoreErrors = []

                this.loadingCreate = false

            }
        },


    },
    mounted() {
        this.moment = moment
    },
};
</script>
