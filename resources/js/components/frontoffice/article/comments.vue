<template>
    <ul class="list-inline mb-2 mt-2" v-if="loading == 1">
        <li class="list-inline-item">
            <button class="btn btn-outline-light btn-sm ">
                <i  style="color: green; font-size: 20px;" class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span>
                Chargement des données ...
            </button>
        </li>
    </ul>
    <ul class="list-inline mb-2 mt-2" v-if="loading == 2">
        <li class="list-inline-item">
            <button class="btn btn-danger btn-sm">
                <i class="fa fa-exclamation-triangle fa-1x fa-fw"></i>
                Impossible de charger les données.
            </button>
        </li>
    </ul>
    <hr>
    <div v-if="loading == 0" class="mt-2">
        <h4>Ajouter un commentaire</h4>
        <form class="row g-3 mt-2">
            <div v-if="errorComment">
                <br>
                <div class="alert alert-danger"  role="alert">
                    {{ errorComment }}
                </div>
            </div>
            <div class="col-12" v-if="errorsComment.content">
                <label class="form-label">Votre commentaire</label>
                <textarea class="form-control is-invalid" v-model="content" rows="4"></textarea>
                <div id="exampleInputEmail1" v-for="errorContent in errorsComment.content" :key="errorContent" class="invalid-feedback">
                    {{ errorContent }}
                </div>
            </div>
            <div class="col-12" v-else>
                <label class="form-label">Votre commentaire</label>
                <textarea class="form-control" v-model="content" rows="4"></textarea>
            </div>
            <div class="col-12" style="float: right" v-if="!loadingCreate">
                <button type="button" @click="cancel"  class="btn btn-sm btn-outline-light">Annuler</button>
               &nbsp; <button type="button" @click="actionComments" class="btn btn-sm btn-success-soft">Ajouter</button>
            </div>
            <div class="col-12" style="float: right" v-else-if="loadingCreate">
                <button type="button" disabled  class="btn btn-sm btn-success">
                    <i  style="color: #fff; font-size: 20px;" class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span>
                    <span style="color:#fff;">Envoi en cours ...</span>
                </button>
            </div>
        </form>
        <hr>
        <h4> {{ states.comment_count }} commentaire<span v-if="states.comment_count < 2"></span> <span v-else>s</span></h4>
        <div class="my-4 d-flex" v-for="result in comments " :key="result.id">
            <div class="avatar avatar-sm me-2">
                <div class="avatar-img rounded-circle bg-success">
                    <span class="text-white position-absolute top-50 start-50 translate-middle fw-bold ">{{ result.username[0].toUpperCase()  }}</span>
                </div>
            </div>
            <div>
              <div class="mb-2">
                  <h6 class="m-0"> {{ result.username }} </h6>
                  <span class="me-3 small">{{ moment(result.date_publish).format("DD/MM/YYYY") }} </span>
                  <a href="#" class="text-body fw-normal">Répondre</a>
                  &nbsp; <a href="#" class="text-body fw-normal">Signaler</a>
              </div>
              <p v-html="result.content"></p>
            </div>
        </div>
    </div>
    <div class="modal fade" id="authFormModalComments" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Login Form -->

                <div class="modal-header">
                    <h5 class="modal-title" v-if="authPage == 1">Se connecter</h5>
                    <h5 class="modal-title" v-else-if="authPage == 2">Modifier le mot de passe</h5>
                    <h5 class="modal-title" v-else-if="authPage == 3">S'inscrire</h5>
                    <button type="button" class="btn-close" @click="authFormModalCommentsClose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >
                    <div  v-if="authPage == 2">
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
                                    <div id="exampleInputEmail1" v-for="errorForgotPasswordemail in errorsForgotPasswordFirst.email" :key="errorForgotPasswordemail" class="invalid-feedback">
                                        {{ errorForgotPasswordemail }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <input type="email" v-model="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Veuillez entrer votre email">
                                </div>
                                <!-- Button -->
                                <div class="mb-3 form-check">
                                    <span v-if="authPage != 2"  @click="changeAuthPageToForgotPassword" style="cursor: pointer; color: blue">Mot de passe oublié</span>
                                    <span v-else   @click="changeAuthPageToLogin" style="cursor: pointer; color: blue">Se connecter</span>
                                </div>
                                <button type="button" disabled v-if="loadingForgotPasswordFirst" class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                    <span class="sr-only">Loading...</span>Vérification</button>
                                <button type="submit" @click.prevent="submitVerifyForgotPasswordEmail" v-else class="btn btn-success  mx-auto w-100">Verifier</button>
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
                                    <div id="exampleInputOtp1" v-for="errorForgotPasswordOtp in errorsForgotPasswordTwo.otp" :key="errorForgotPasswordOtp" class="invalid-feedback">
                                        {{ errorForgotPasswordOtp }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>

                                    <input type="text"  v-model="otp" name="otp" class="form-control" id="exampleInputOtp1" placeholder="Veuillez entrer votre code de vérification">
                                </div>
                                <div class="mb-3">
                                    <span for="exampleInputOtp1" @click.prevent="submitVerifyForgotPasswordEmail"><u style="color: blue; cursor:pointer">Renvoyer un nouveau code </u></span>
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
                                        <span><span class="btn btn-primary  mx-auto w-100" @click="PreviousForgotPasswordStep">Retour</span></span>
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
                                    <input type="password" v-model="password" name="password" class="form-control is-invalid" id="exampleInputpassword1" placeholder="Veuillez entrer votre nouveau mot de passe">
                                    <div id="exampleInputpassword1" v-for="errorForgotPasswordpassword in errorsForgotPasswordThree.password" :key="errorForgotPasswordpassword" class="invalid-feedback">
                                        {{ errorForgotPasswordpassword }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Votre nouveau mot de passe</label>
                                    <input type="password"  v-model="password" name="password" class="form-control" id="exampleInputpassword1" placeholder="Veuillez entrer votre nouveau mot de passe">
                                </div>

                                <div class="mb-3" v-if="errorsForgotPasswordThree.password_confirm">
                                    <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                    <input type="password" v-model="password_confirm" name="password_confirm" class="form-control is-invalid" id="exampleInputpassword1" placeholder="Veuillez entrer confirmer le mot de passe">
                                    <div id="exampleInputpassword1" v-for="errorForgotPasswordpassword_confirm in errorsForgotPasswordThree.password_confirm" :key="errorForgotPasswordpassword_confirm" class="invalid-feedback">
                                        {{ errorForgotPasswordpassword_confirm }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                    <input type="password"  v-model="password_confirm" name="password_confirm" class="form-control" id="exampleInputpassword1" placeholder="Veuillez entrer confirmer le mot de passe">
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
                                        <span><span class="btn btn-primary  mx-auto w-100" @click="PreviousHForgotPasswordStep">Retour</span></span>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" @click.prevent="submitForgotPasswordNewPass" class="btn btn-success  mx-auto w-100">Modifier</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div  v-if="authPage == 3">
                        <h6 v-if="stepF === 1">Votre email</h6>
                        <h6 v-else-if="stepF === 2">Code d' activation</h6>
                        <h6 v-else-if="stepF === 4">Mon profil</h6>
                        <h6 v-else-if="stepF === 3">Nouveau mot de passe</h6>

                        <div v-if="stepF === 1">
                            <div v-if="errorRegisterFirst" class="mb-3">
                                <div class="alert alert-danger"  role="alert">
                                    {{ errorRegisterFirst }}
                                </div>
                            </div>
                            <form >
                                <div class="mb-3" v-if="errorsRegisterFirst.email">
                                    <input type="email" v-model="email" name="email" class="form-control is-invalid" id="exampleInputEmail1" placeholder="Veuillez entrer votre email">
                                    <div id="exampleInputEmail1" v-for="errorRegisteremail in errorsRegisterFirst.email" :key="errorRegisteremail" class="invalid-feedback">
                                        {{ errorRegisteremail }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <input type="email" v-model="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Veuillez entrer votre email">
                                </div>
                                <!-- Button -->
                                <div class="mb-3 form-check">
                                    <span v-if="authPage != 2"  @click="changeAuthPageToForgotPassword" style="cursor: pointer; color: blue">Mot de passe oublié</span>
                                    <span v-else   @click="changeAuthPageToLogin" style="cursor: pointer; color: blue">Se connecter</span>
                                </div>
                                <button type="button" disabled v-if="loadingRegisterFirst" class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                    <span class="sr-only">Loading...</span>Vérification</button>
                                <button type="submit" @click.prevent="submitVerifyRegisterEmail" v-else class="btn btn-success  mx-auto w-100">Verifier</button>
                            </form>
                        </div>
                        <div v-if="stepF === 2">
                            <div v-if="errorRegisterTwo" class="mb-3">

                                <div class="alert alert-danger"  role="alert">
                                    {{ errorRegisterTwo }}
                                </div>
                            </div>
                            <form>
                                <div class="mb-3" v-if="errorsRegisterTwo.otp">

                                    <input type="text" v-model="otp" name="otp" class="form-control is-invalid" id="exampleInputOtp1" placeholder="Veuillez entrer votre code de vérification">
                                    <div id="exampleInputOtp1" v-for="errorRegisterOtp in errorsRegisterTwo.otp" :key="errorRegisterOtp" class="invalid-feedback">
                                        {{ errorRegisterOtp }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>

                                    <input type="text"  v-model="otp" name="otp" class="form-control" id="exampleInputOtp1" placeholder="Veuillez entrer votre code de vérification">
                                </div>
                                <div class="mb-3">
                                    <span for="exampleInputOtp1" @click.prevent="submitVerifyRegisterEmail"><u style="color: blue; cursor:pointer">Renvoyer un nouveau code </u></span>
                                </div>
                                <div class="row" v-if="loadingRegisterTwo">
                                    <div class="col-md-12">
                                        <button type="button" disabled class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                            <span class="sr-only">Loading...</span>Validation
                                        </button>
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-md-6">
                                        <span><span class="btn btn-primary  mx-auto w-100" @click="PreviousRegisterStep">Retour</span></span>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" @click.prevent="submitVerifyRegisterOtp" class="btn btn-success  mx-auto w-100">Valider</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-if="stepF === 3">
                            <div v-if="errorRegisterThree" class="mb-3">
                                <div class="alert alert-danger"  role="alert">
                                    {{ errorRegisterThree }}
                                </div>
                            </div>
                            <form>
                                <div class="mb-3" v-if="errorsRegisterThree.password">
                                    <label class="form-label" for="exampleInputpassword1">Votre nouveau mot de passe</label>
                                    <input type="password" v-model="password" name="password" class="form-control is-invalid" id="exampleInputpassword1" placeholder="Veuillez entrer votre nouveau mot de passe">
                                    <div id="exampleInputpassword1" v-for="errorRegisterpassword in errorsRegisterThree.password" :key="errorRegisterpassword" class="invalid-feedback">
                                        {{ errorRegisterpassword }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Votre nouveau mot de passe</label>
                                    <input type="password"  v-model="password" name="password" class="form-control" id="exampleInputpassword1" placeholder="Veuillez entrer votre nouveau mot de passe">
                                </div>

                                <div class="mb-3" v-if="errorsRegisterThree.password_confirm">
                                    <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                    <input type="password" v-model="password_confirm" name="password_confirm" class="form-control is-invalid" id="exampleInputpassword1" placeholder="Veuillez confirmer le mot de passe">
                                    <div id="exampleInputpassword1" v-for="errorRegisterpassword_confirm in errorsRegisterThree.password_confirm" :key="errorRegisterpassword_confirm" class="invalid-feedback">
                                        {{ errorRegisterpassword_confirm }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                    <input type="password"  v-model="password_confirm" name="password_confirm" class="form-control" id="exampleInputpassword1" placeholder="Veuillez confirmer le mot de passe">
                                </div>
                                <div class="row" v-if="loadingRegisterThree">
                                    <div class="col-md-12">
                                        <button type="button" disabled class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                            <span class="sr-only">Loading...</span>chargement
                                        </button>
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-md-6">
                                        <span><span class="btn btn-primary  mx-auto w-100" @click="PreviousHHRegisterStep">Retour</span></span>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" @click.prevent="submitRegisterNewPass" class="btn btn-success  mx-auto w-100">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div v-if="stepF === 4">
                            <div v-if="errorRegisterFour" class="mb-3">
                                <div class="alert alert-danger"  role="alert">
                                    {{ errorRegisterFour }}
                                </div>
                            </div>
                            <form>
                                <div class="mb-3" v-if="errorsRegisterFour.nom">
                                    <label class="form-label" for="exampleInputnom1">Votre nom</label>
                                    <input type="text" v-model="nom" name="nom" class="form-control is-invalid" id="exampleInputnom1" placeholder="Veuillez entrer votre nom">
                                    <div id="exampleInputnom1" v-for="errorRegisternom in errorsRegisterFour.nom" :key="errorRegisternom" class="invalid-feedback">
                                        {{ errorRegisternom }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Votre nom</label>
                                    <input type="text"  v-model="nom" name="nom" class="form-control" id="exampleInputpassword1" placeholder="Veuillez entrer votre nom">
                                </div>

                                <div class="mb-3" v-if="errorsRegisterFour.prenoms">
                                    <label class="form-label" for="exampleInputprenoms1">Votre prénom</label>
                                    <input type="text" v-model="prenoms" name="prenoms" class="form-control is-invalid" id="exampleInputprenoms1" placeholder="Veuillez entrer votre prénom">
                                    <div id="exampleInputprenoms1" v-for="errorRegisterprenoms in errorsRegisterFour.prenoms" :key="errorRegisterprenoms" class="invalid-feedback">
                                        {{ errorRegisterprenoms }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Votre prénom</label>
                                    <input type="text"  v-model="prenoms" name="prenoms" class="form-control" id="exampleInputpassword1" placeholder="Veuillez entrer votre prénom">
                                </div>

                                <div class="mb-3" v-if="errorsRegisterFour.username">
                                    <label class="form-label" for="exampleInputusername1">Votre nom d'utilisateur</label>
                                    <input type="text" v-model="username" name="username" class="form-control is-invalid" id="exampleInputusername1" placeholder="Veuillez entrer votre nom d'utilisateur">
                                    <div id="exampleInputusername1" v-for="errorRegisterusername in errorsRegisterFour.username" :key="errorRegisterusername" class="invalid-feedback">
                                        {{ errorRegisterusername }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Votre nom d'utilisateur</label>
                                    <input type="text"  v-model="username" name="username" class="form-control" id="exampleInputpassword1" placeholder="Veuillez entrer votre nom d'utilisateur">
                                </div>

                                <div class="row" v-if="loadingRegisterFour">
                                    <div class="col-md-12">
                                        <button type="button" disabled class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                            <span class="sr-only">Loading...</span>chargement
                                        </button>
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-md-6">
                                        <span><span class="btn btn-primary  mx-auto w-100" @click="PreviousHRegisterStep">Retour</span></span>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" @click.prevent="submitRegisterNewInfo" class="btn btn-success  mx-auto w-100">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div  v-else-if="authPage == 1">
                        <div v-if="errorLogin">
                            <div class="alert alert-danger"  role="alert">
                                {{ errorLogin }}
                            </div>
                        </div>
                        <form>
                            <!-- Email -->
                            <div class="mb-3" v-if="errorsLogin.username">
                                <label class="form-label" for="exampleInputEmail1">Nom d'utilisateur ou email</label>
                                <input type="text" v-model="username" name="username" class="form-control is-invalid" id="exampleInputEmail1" placeholder="Votre nom d'utilisateur ou votre email">
                                <div id="exampleInputEmail1" v-for="errorUsername in errorsLogin.username" :key="errorUsername" class="invalid-feedback">
                                    {{ errorUsername }}
                                </div>
                            </div>
                            <div class="mb-3" v-else>
                                <label class="form-label" for="exampleInputEmail1">Nom d'utilisateur ou email</label>
                                <input type="text" v-model="username" name="username" class="form-control" id="exampleInputEmail1" placeholder="Votre nom d'utilisateur ou votre email">
                            </div>
                            <!-- Password -->
                            <div class="mb-3" v-if="errorsLogin.password">
                                <label class="form-label" for="exampleInputPassword1">Mot de passe</label>
                                <input type="password"  v-model="password" name="password" class="form-control is-invalid" id="exampleInputPassword1" placeholder="*********">
                                <div id="exampleInputPassword1" v-for="errorPassword in errorsLogin.password" :key="errorPassword" class="invalid-feedback">
                                    {{ errorPassword }}
                                </div>
                            </div>
                            <div class="mb-3" v-else>
                                <label class="form-label"  for="exampleInputPassword1">Mot de passe</label>
                                <input type="password"  v-model="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="*********">
                            </div>
                            <!-- Checkbox -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember_me" v-model="remember_me" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
                                <span v-if="authPage != 2" class="float-end" @click="changeAuthPageToForgotPassword" style="cursor: pointer; color: blue">Mot de passe oublié</span>
                                <span v-else class="float-end"  @click="changeAuthPageToLogin" style="cursor: pointer; color: blue">Se connecter</span>
                            </div>

                            <button type="button" disabled v-if="loadingLogin" class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                <span class="sr-only">Loading...</span>  Connexion</button>
                            <button type="submit"  @click.prevent="submitLogin" v-else class="btn btn-success  mx-auto w-100">Se connecter</button>

                        </form>

                    </div>
                    <div class="container">
                        <p class="text-center">Se connecter par le canal des réseaux sociaux</p>
                        <div class="row">
                            <a href="#" class="btn bg-google"><i class="fab fa-google me-2"></i> &nbsp; Connexion via Google</a>  
                            <a href="#" class="btn bg-facebook"><i class="fab fa-facebook-f me-2"></i> &nbsp; Connexion via Facebook</a>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">

                </div>
                <div v-if="authPage == 1">
                    <p class="text-center">Pas encore de compte? <span @click="changeAuthPageToRegister" style="cursor: pointer; color: blue"> S'inscrire</span></p>
                </div>
                <div v-else-if="authPage == 2">
                    <p class="text-center">Pas encore de compte? <span @click="changeAuthPageToRegister" style="cursor: pointer; color: blue"> S'inscrire</span></p>
                </div>
                <div v-if="authPage == 3">
                    <p class="text-center"> Avez vous déja un compte ? <span @click="changeAuthPageToLogin" style="cursor: pointer; color: blue">Se sonnecter</span></p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions} from "vuex";
import moment from 'moment'
import jwtInterceptor from "../../../shared/jwtInterceptor";
export default{
     
    data(){
        return {
            states: {},
            authPage: 1,
            step: 1,
            stepF: 1,
            message: null,
            loading: 1,
            loadingCreate: false,
            content: null,
            errorComment: false,
            errorsComment: [],
            message: null,
            dataReady: 0,
            meProfileUserName: null,
            meProfileRoleName: null,
            nom: null,
            prenoms: null,
            username:null,
            email:null,
            otp:null,
            password_confirm: null,
            password: null,
            loadingLogin: false,
            errorLogin: false,
            errorsLogin: [],
            loadingRegisterFirst: false,
            errorRegisterFirst: false,
            errorsRegisterFirst: [],
            loadingRegisterTwo: false,
            errorRegisterTwo: false,
            errorsRegisterTwo: [],
            loadingRegisterThree: false,
            errorRegisterThree: false,
            errorsRegisterThree: [],
            loadingRegisterFour: false,
            errorRegisterFour: false,
            errorsRegisterFour: [],
            loadingForgotPasswordFirst: false,
            errorForgotPasswordFirst: false,
            errorsForgotPasswordFirst: [],
            loadingForgotPasswordTwo: false,
            errorForgotPasswordTwo: false,
            errorsForgotPasswordTwo: [],
            loadingForgotPasswordThree: false,
            errorForgotPasswordThree: false,
            errorsForgotPasswordThree: [],
            remember_me: false,
            initialData: null,
        }
    },

    computed: {
        ...mapGetters('login',{
            getterLoginStatus:'getLoginStatus',
            getterLoginMessage:'getLoginMessage',
            getterLoginErrors:'getLoginErrors',
        }),

        ...mapGetters("meProfile",{
            gettersMeProfileUserName:"getMeProfileUserName",
            gettersMeProfileRoleName:"getMeProfileRoleName",
            gettersProfileStatus:'getMeProfileStatus',
        }),
        ...mapGetters('visitorsActionsComments',{
            getterInfosCreateVisitorCommentsStatus:'getInfosCreateVisitorCommentsStatus',
            getterInfosCreateVisitorCommentsMessage:'getInfosCreateVisitorCommentsMessage',
            getterInfosCreateVisitorCommentsData:'getInfosCreateVisitorCommentsData',
            getterInfosCheckVisitorCommentsStatus:'getInfosCheckVisitorCommentsStatus',
            getterInfosCheckVisitorCommentsMessage:'getInfosCheckVisitorCommentsMessage',
            getterInfosCheckVisitorCommentsData:'getInfosCheckVisitorCommentsData',
        }),

        ...mapGetters('article',{
            getterInfosCheckArticleCommentsListStatus:'getInfosCheckArticleCommentsListStatus',
            getterInfosCheckArticleCommentsListData:'getInfosCheckArticleCommentsListData',
            getterInfosCheckArticleCommentsListMessage:'getInfosCheckArticleCommentsListMessage',
            getterInfosCheckArticleCommentsAddStatus:'getInfosCheckArticleCommentsAddStatus',
            getterInfosCheckArticleCommentsAddMessage:'getInfosCheckArticleCommentsAddMessage',
            getterInfosCheckArticleCommentsAddData:'getInfosCheckArticleCommentsAddData',
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

        ...mapGetters("register",{
            gettersSendOtpRegisterStatus:'getSendOtpRegisterStatus',
            gettersSendOtpRegisterErrors:'getSendOtpRegisterErrors',
            gettersSendOtpRegisterMessage:'getSendOtpRegisterMessage',
            gettersCheckOtpRegisterStatus:'getCheckOtpRegisterStatus',
            gettersCheckOtpRegisterErrors:'getCheckOtpRegisterErrors',
            gettersCheckOtpRegisterMessage:'getCheckOtpRegisterMessage',
            gettersNewInfoOtpRegisterStatus:'getNewInfoOtpRegisterStatus',
            gettersNewInfoOtpRegisterErrors:'getNewInfoOtpRegisterErrors',
            gettersNewInfoOtpRegisterMessage:'getNewInfoOtpRegisterMessage',
            gettersNewPassOtpRegisterStatus:'getNewPassOtpRegisterStatus',
            gettersNewPassOtpRegisterErrors:'getNewPassOtpRegisterErrors',
            gettersNewPassOtpRegisterMessage:'getNewPassOtpRegisterMessage',
            getterLoginStatusRegister:'getLoginStatus',
            getterLoginMessageRegister:'getLoginMessage',
        }),
    },

    methods:{

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

        ...mapActions('visitorsActionsComments',{
            actionCreateVisitorCommentsDataRequest:'createVisitorCommentsDataRequest',
            actionCheckVisitorCommentsDataRequest:'checkVisitorCommentsDataRequest'
        }),

        ...mapActions('article',{
            actionCheckArticleCommentsStateDataRequest:'checkArticleCommentsStateDataRequest',
            actionCheckArticleCommentsAddDataRequest:'checkArticleCommentsAddDataRequest'
        }),
        ...mapActions('login',{
            actionLogin:'login'
        }),

        ...mapActions("meProfile",{
            actionsGetMeProfile:'getMeProfile'
        }),

        async actionComments(){

             this.initialData = window.location.href.replace('https://news228.com/', '')

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                 this.initialData = window.location.href.replace('https://news228.com/', '')

                await this.actionsGetMeProfile();

                if(this.gettersProfileStatus === 'success'){

                    this.meProfileRoleName = this.gettersMeProfileRoleName

                    this.meProfileUserName = this.gettersMeProfileUserName

                    this.initialComments()


                }else if(this.gettersProfileStatus === 'failed'){

                    this.dataReady = 3;

                    if(localStorage.getItem('username') && localStorage.getItem('password')){

                        this.username = localStorage.getItem('username')

                        this.password = localStorage.getItem('password')

                        this.remember_me = localStorage.getItem('remember_me')

                    }

                    $('#authFormModalComments').modal('show');

                }

            }else{

                this.dataReady = 2;

                if(localStorage.getItem('username') && localStorage.getItem('password')){

                    this.username = localStorage.getItem('username')

                    this.password = localStorage.getItem('password')

                    this.remember_me = localStorage.getItem('remember_me')

                }

                $('#authFormModalComments').modal('show');

            }


        },

        async submitVerifyRegisterEmail(){
                this.loadingRegisterFirst = true

                await this.actionsSendOtpRegister({email:this.email});

                if(this.gettersSendOtpRegisterStatus === 'success'){

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
                            title: this.gettersSendOtpRegisterMessage
                        })

                        this.loadingRegisterFirst = false

                        this.stepF = 2

                }else if(this.gettersSendOtpRegisterStatus === 'failed'){

                    this.errorRegisterFirst = this.gettersSendOtpRegisterMessage

                    this.loadingRegisterFirst = false

                }else if(this.gettersSendOtpRegisterStatus === 'error'){

                    this.errorRegisterFirst = this.gettersSendOtpRegisterMessage

                    this.errorsRegisterFirst = this.gettersSendOtpRegisterErrors

                    this.loadingRegisterFirst = false
                }

                this.loadingRegisterFirst = false
            },

            async submitRegisterNewInfo(){
                this.loadingRegisterFour = true

                await this.actionsNewInfoOtpRegister({email:this.email, otp :this.otp, nom:this.nom , prenoms:this.prenoms, username: this.username});

                if(this.gettersNewInfoOtpRegisterStatus === 'success'){

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
                            title: this.gettersNewInfoOtpRegisterMessage
                        })

                       this.stepF = 3

                }else if(this.gettersNewInfoOtpRegisterStatus === 'failed'){

                    this.errorRegisterFour = this.gettersNewInfoOtpRegisterMessage

                    this.loadingRegisterFour = false

                }else if(this.gettersNewInfoOtpRegisterStatus === 'error'){

                    this.errorRegisterFour = this.gettersNewInfoOtpRegisterMessage

                    this.errorsRegisterFour = this.gettersNewInfoOtpRegisterErrors

                    this.loadingRegisterFour = false
                }
                this.loadingRegisterFour = false

            },

            async submitRegisterNewPass(){
                this.loadingRegisterThree = true

                await this.actionsNewPassOtpRegister({email:this.email, otp :this.otp, password :this.password ,password_confirm :this.password_confirm,  nom:this.nom , prenoms:this.prenoms});

                if(this.gettersNewPassOtpRegisterStatus === 'success'){

                    if(this.getterLoginStatusRegister === 'success visitor'){

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
                            title: this.getterLoginMessageRegister
                        })

                        if(this.remember_me){

                            if(this.username == null){

                                this.username = this.prenoms

                            }

                            localStorage.setItem('username', this.username )

                            localStorage.setItem('password', this.password)

                            localStorage.setItem('remember_me', true)

                            this.loadingRegisterThree = false

                            $('#authFormModalComments').modal('hide');

                            this.actionComments()


                        }else{

                            localStorage.setItem('remember_me', false)

                            this.loadingRegisterThree = false

                            $('#authFormModalComments').modal('hide');

                            this.actionComments()
                        }
                    }

                }else if(this.gettersNewPassOtpRegisterStatus === 'failed'){

                    this.errorRegisterThree = this.gettersNewPassOtpRegisterMessage

                    this.loadingRegisterThree = false

                }else if(this.gettersNewPassOtpRegisterStatus === 'error'){

                    this.errorRegisterThree = this.gettersNewPassOtpRegisterMessage

                    this.errorsRegisterThree = this.gettersNewPassOtpRegisterErrors

                    this.loadingRegisterThree = false
                }
                this.loadingRegisterThree = false

            },

            async submitVerifyRegisterOtp(){
                this.loadingRegisterTwo = true

                await this.actionsCheckOtpRegister({email:this.email, otp :this.otp });

                if(this.gettersCheckOtpRegisterStatus === 'success'){

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
                            title: this.gettersCheckOtpRegisterMessage
                        })


                        this.loadingRegisterTwo = false

                        this.stepF = 4

                }else if(this.gettersCheckOtpRegisterStatus === 'failed'){

                    this.errorRegisterTwo = this.gettersCheckOtpRegisterMessage

                    this.loadingRegisterTwo = false

                }else if(this.gettersCheckOtpRegisterStatus === 'error'){

                    this.errorRegisterTwo = this.gettersCheckOtpRegisterMessage

                    this.errorsRegisterTwo = this.gettersCheckOtpRegisterErrors

                    this.loadingRegisterTwo = false
                }
                this.loadingRegisterTwo = false
            },

            async submitVerifyForgotPasswordEmail(){
                this.loadingForgotPasswordFirst = true

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


                        this.loadingForgotPasswordFirst = false

                        this.step = 2

                }else if(this.gettersSendOtpForgotPasswordStatus === 'failed'){

                    this.errorForgotPasswordFirst = this.gettersSendOtpForgotPasswordMessage

                    this.loadingForgotPasswordFirst = false

                }else if(this.gettersSendOtpForgotPasswordStatus === 'error'){

                    this.errorForgotPasswordFirst = this.gettersSendOtpForgotPasswordMessage

                    this.errorsForgotPasswordFirst = this.gettersSendOtpForgotPasswordErrors

                    this.loadingForgotPasswordFirst = false
                }

                this.loadingForgotPasswordFirst = false
            },

            async submitForgotPasswordNewPass(){
                this.loadingForgotPasswordThree = true

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



                       this.authPage = 1

                }else if(this.gettersNewPassOtpForgotPasswordStatus === 'failed'){

                    this.errorForgotPasswordThree = this.gettersNewPassOtpForgotPasswordMessage

                    this.loadingForgotPasswordThree = false

                }else if(this.gettersNewPassOtpForgotPasswordStatus === 'error'){

                    this.errorForgotPasswordThree = this.gettersNewPassOtpForgotPasswordMessage

                    this.errorsForgotPasswordThree = this.gettersNewPassOtpForgotPasswordErrors

                    this.loadingForgotPasswordThree = false
                }
                this.loadingForgotPasswordThree = false

            },

            async submitVerifyForgotPasswordOtp(){
                this.loadingForgotPasswordTwo = true

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


                        this.loadingForgotPasswordTwo = false

                        this.step = 3

                }else if(this.gettersCheckOtpForgotPasswordStatus === 'failed'){

                    this.errorForgotPasswordTwo = this.gettersCheckOtpForgotPasswordMessage

                    this.loadingForgotPasswordTwo = false

                }else if(this.gettersCheckOtpForgotPasswordStatus === 'error'){

                    this.errorForgotPasswordTwo = this.gettersCheckOtpForgotPasswordMessage

                    this.errorsForgotPasswordTwo = this.gettersCheckOtpForgotPasswordErrors

                    this.loadingForgotPasswordTwo = false
                }
                this.loadingForgotPasswordTwo = false
            },

            PreviousForgotPasswordStep(){

                this.step = 1
                this.loading = false
            },

            PreviousHForgotPasswordStep(){
                this.step = 2
                this.loading = false
            },

            PreviousRegisterStep(){

                this.stepF = 1
                this.loading = false
            },

            PreviousHRegisterStep(){
                this.stepF = 2
                this.loading = false
            },

            PreviousHHRegisterStep(){
                this.stepF = 3
                this.loading = false
            },


            async submitLogin(){
                this.loadingLogin = true
                await this.actionLogin({username:this.username, password:this.password, remember_me: this.remember_me});

                if(this.getterLoginStatus === 'success admin'){



                    if(this.remember_me){

                        localStorage.setItem('username', this.username )

                        localStorage.setItem('password', this.password)

                        localStorage.setItem('remember_me', true)

                        this.loadingLogin = false

                        $('#authFormModalComments').modal('hide');

                        this.actionComments()


                    }else{

                        localStorage.setItem('remember_me', false)

                        this.loading = false

                        $('#authFormModalComments').modal('hide');

                        this.actionComments()
                    }



                }else if(this.getterLoginStatus === 'success pub'){



                    if(this.remember_me){

                        localStorage.setItem('username', this.username )

                        localStorage.setItem('password', this.password)

                        localStorage.setItem('remember_me', true)

                        this.loadingLogin = false

                        $('#authFormModalComments').modal('hide');

                        this.actionComments()


                    }else{

                        localStorage.setItem('remember_me', false)

                        this.loadingLogin = false

                        $('#authFormModalComments').modal('hide');

                        this.actionComments()
                    }



                }else if(this.getterLoginStatus === 'success visitor'){

                    if(this.remember_me){

                        localStorage.setItem('username', this.username )

                        localStorage.setItem('password', this.password)

                        localStorage.setItem('remember_me', true)

                        this.loadingLogin = false

                        $('#authFormModalComments').modal('hide');

                        this.actionComments()


                    }else{

                        localStorage.setItem('remember_me', false)

                        this.loadingLogin = false

                        $('#authFormModalComments').modal('hide');

                        this.actionComments()
                    }



                }else if(this.getterLoginStatus === 'failed'){

                    this.errorLogin = this.getterLoginMessage

                    this.loadingLogin = false

                }else if(this.getterLoginStatus === 'error'){

                    this.errorLogin = this.getterLoginMessage

                    this.errorsLogin = this.getterLoginErrors

                    this.loadingLogin = false
                }
            },

            authFormModalCommentsClose(){
                $('#authFormModalComments').modal('hide');
            },

            changeAuthPageToRegister(){
                this.authPage = 3
            },

            changeAuthPageToLogin(){
                this.authPage = 1
            },

            changeAuthPageToForgotPassword(){
                this.authPage = 2
            },


            async getResults(){
                this.loading = 1

                if(localStorage.getItem('mtrc') == null){

                    this.createVisitorCommentsMatricule()

                }else{

                    await this.actionCheckVisitorCommentsDataRequest({});

                    if(this.getterInfosCheckVisitorCommentsStatus ==="empty"){

                        this.createVisitorCommentsMatricule()

                    }else if(this.getterInfosCheckVisitorCommentsStatus ==="success"){

                        this.initialState()

                    }


                }
            },


            async getResultsH(){

                if(localStorage.getItem('mtrc') == null){

                    this.createVisitorCommentsMatricule()

                }else{

                    await this.actionCheckVisitorCommentsDataRequest({});

                    if(this.getterInfosCheckVisitorCommentsStatus ==="empty"){

                        this.createVisitorCommentsMatricule()

                    }else if(this.getterInfosCheckVisitorCommentsStatus ==="success"){

                        this.initialStateH()

                    }


                }
            },


            async createVisitorCommentsMatricule(){

                await this.actionCreateVisitorCommentsDataRequest({});

                if( this.getterInfosCreateVisitorCommentsStatus ==="success"){

                    this.createVisitorData = this.getterInfosCreateVisitorCommentsData

                    localStorage.setItem('mtrc', this.getterInfosCreateVisitorCommentsData.visitor_matricule_create.matricule_reference)

                    this.initialState()

                }else if( this.getterInfosCreateVisitorCommentsStatus ==="empty"){

                    this.createVisitorCommentsMessage = this.getterInfosCreateVisitorCommentsMessage

                    const Toast = this.$swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', this.$swal.stopTimer)
                            toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: this.getterInfosCreateVisitorCommentsMessage
                    })

                }else{

                    this.createVisitorCommentsMessage = this.getterInfosCreateVisitorCommentsMessage

                    const Toast = this.$swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', this.$swal.stopTimer)
                            toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: this.getterInfosCreateVisitorCommentsMessage
                    })

                    this.loading = false

                }

            },

            async initialState(){

                this.loading = 1

                 this.initialData = window.location.href.replace('https://news228.com/', '')

                await this.actionCheckArticleCommentsStateDataRequest({slug: this.initialData});

                if(this.getterInfosCheckArticleCommentsListStatus === 200){

                    this.states = this.getterInfosCheckArticleCommentsListData.article

                    this.comments = this.getterInfosCheckArticleCommentsListData.comments

                    this.loading = 0

                }else if(this.getterInfosCheckArticleCommentsListStatus === 422){

                    this.message = this.getterInfosCheckArticleCommentsListMessage

                    this.loading = 2

                }

            },


        async initialStateH(){

             this.initialData = window.location.href.replace('https://news228.com/', '')

                await this.actionCheckArticleCommentsStateDataRequest({slug: this.initialData});

                if(this.getterInfosCheckArticleCommentsListStatus === 200){

                    this.states = this.getterInfosCheckArticleCommentsListData.article

                    this.comments = this.getterInfosCheckArticleCommentsListData.comments



                }else if(this.getterInfosCheckArticleCommentsListStatus === 422){

                    this.message = this.getterInfosCheckArticleCommentsListMessage



                }

        },


        initialComments(){

            this.loadingCreate = true
             this.initialData = window.location.href.replace('https://news228.com/', '')
            jwtInterceptor.post(`article/${this.initialData}/actions_comments/${localStorage.getItem('mtrc')}/comments_creator`, {content: this.content})
            .then(response => {

                if(response.data.data.status == 200){

                    this.states.comment_count += 1

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
                            title: "Merci d'avoir commenter cet article"
                        })

                        this.loadingCreate = false

                        this.content = null

                        this.getResultsH()

                }else if(response.data.data.status == 401){

                    this.loadingCreate = false

                    this.errorsComment = response.data.data.errors

                    this.errorComment = response.data.message

                }else if(response.data.data.status == 422){

                    this.loadingCreate = false

                    this.errorComment = response.data.message

                }
            });

        }
    },

    mounted(){
        this.moment = moment
         this.initialData = window.location.href.replace('https://news228.com/', '')
        this.getResults();
    }
}
</script>
