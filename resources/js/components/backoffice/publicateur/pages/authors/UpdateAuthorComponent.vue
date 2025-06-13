<template>
    <section class="py-4">
        <div class="container">
            <div  v-if="dataReady == 0" >
                <br/><br/><br/><br/><br/><br/><br/>
                <div class="d-flex justify-content-center">
                    <img src="https://actualitetogo.com/assets/images/logo.png"  style="width: 150px;" alt="empty">
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <div class="spinner-border text-success" style="color: #006633" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <br/><br/><br/><br/><br/><br/><br/>
            </div>
            <div v-else-if="dataReady== 1">
                <!-- Author list title START -->
                <div class="row g-4 pb-4">
                    <div class="col-12">
                        <!-- Title -->
                        <div class="d-sm-flex justify-content-sm-between align-items-center">
                            <h1 class="mb-2 mb-sm-0 h2">Modifier un auteur </h1>
                            <router-link style="cursor: pointer" :to="{'name': 'pub.authors'}" class="btn btn-sm btn-primary mb-0"><i class="fas fa-eye me-2"></i>Voir les auteurs</router-link>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <!-- Left sidebar START -->
                    <div class="col-lg-12 col-xxl-8">
                        <!-- Profile START -->
                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h5 class="card-header-title mb-0">Modifier un auteur</h5>
                            </div>
                            <div class="card-body" v-if="empty == 0">

                                <div v-if="authorsUpdateMessage">
                                    <div class="alert alert-danger"  role="alert">
                                        {{ authorsUpdateMessage }}
                                    </div>
                                </div>
                                <form>
                                  <!-- Full name -->
                                  <div class="mb-3"  v-if="authorsUpdateErrors.nom || authorsUpdateErrors.prenoms">
                                    <label class="form-label">Nom Complet <sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                      <input type="text" class="form-control is-invalid" v-model="nom" name="nom" placeholder="Entrez votre nom">
                                      <input type="text" class="form-control is-invalid" v-model="prenoms"  name="prenoms" placeholder="Entrez votre prénom">
                                    </div>
                                    <div v-for="errornom in authorsUpdateErrors.nom" :key="errornom" class="text-danger">
                                        {{ errornom }}
                                    </div>
                                    <div v-for="errorprenoms in authorsUpdateErrors.prenoms" :key="errorprenoms" class="text-danger">
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
                                      <div class="mb-3" v-if="authorsUpdateErrors.authorName">
                                        <label class="form-label">Nom d'auteur</label>
                                        <div class="input-group">
                                          <span class="input-group-text">togoactualite.com/auteurs/</span>
                                          <input type="text" class="form-control is-invalid" v-model="authorName" name="authorName" placeholder="Entrez votre nom d'auteur">
                                        </div>
                                        <div v-for="errorname in authorsUpdateErrors.authorName" :key="errorname" class="text-danger">
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
                                        <div class="mb-3" v-if="authorsUpdateErrors.email">
                                            <label class="form-label">Email <sup class="text-danger">*</sup></label>
                                            <div class="input-group">
                                                <input type="email" class="form-control is-invalid" name="email" v-model="email" placeholder="Entrez votre email">
                                            </div>
                                            <div v-for="erroremail in authorsUpdateErrors.email" :key="erroremail" class="text-danger">
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
                                        <div class="mb-3" v-if="authorsUpdateErrors.telephone">
                                            <label class="form-label">Télephone</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control is-invalid" name="telephone" v-model="telephone" placeholder="Entrez votre télephone">
                                            </div>
                                            <div v-for="errortelephone in authorsUpdateErrors.telephone" :key="errortelephone" class="text-danger">
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
                                        <div class="mb-3" v-if="authorsUpdateErrors.address">
                                            <label class="form-label">Adresse</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control is-invalid" name="address" v-model="address" placeholder="Entrez votre Adresse">
                                            </div>
                                            <div v-for="erroraddress in authorsUpdateErrors.address" :key="erroraddress" class="text-danger">
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
                                      <div class="mb-3" v-if="authorsUpdateErrors.description">
                                        <label class="form-label">Description</label>
                                        <QuillEditor theme="snow" v-model:content="description" placeholder='Redigez le contenu de votre description!' style=" min-height: 100px;" contentType="html" />
                                        <div v-for="errordescription in authorsUpdateErrors.description" :key="errordescription" class="text-danger">
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
                                  <div class="d-flex justify-content-end mt-4" v-if="!loadingUpdate">
                                    <button type="button" @click="cancel" class="btn btn-danger border-0 me-2">Annuler</button>
                                    <button type="submit" @click="update" class="btn btn-primary">Modifier</button>
                                  </div>
                                  <div class="d-flex justify-content-end mt-4" v-else>
                                    <button type="button" disabled class="btn btn-success border-0 me-2">
                                        <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                        <span class="sr-only">Loading...</span>Modification...</button>
                                  </div>
                                </form>

                            </div>
                            <div class="card-body p-3 pb-0" v-else-if="empty == 1">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                      <div style="position: relative; height: 250px;">
                                          <img src="https://actualitetogo.com/assets/images/empty.png" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                                      </div>
                                      <h5 style="text-align: center; margin-top: -50px"> {{ authorsShowMessage  }} </h5>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else-if="dataReady== 2"> <accessUnAuthorizedPub></accessUnAuthorizedPub> </div>
            <div v-else-if="dataReady== 3 || dataReady == 4">
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
                                <h1 class="display-1 text-primary">Session expiré! </h1>
                                <h5>Votre delai de connexion est expiré, connectez vous pour acceder à cette page.</h5>
                                <span style="cursor: pointer"  @click="authFormModalAuthorsUpdateShow('SHOW')" class="btn btn-danger-soft mt-3"><i class="fas fa-long-arrow-alt-left me-3"></i>Se connecter</span>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
     <!-- Modal Form -->
     <div class="modal fade" id="authFormModalAuthorsUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">


            <!-- Login Form -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="authSectionStepModal == 1">Se connecter</h5>
                    <h5 class="modal-title" v-else-if="authSectionStepModal == 2">Modifier le mot de passe</h5>
                    <h5 class="modal-title" v-else-if="authSectionStepModal == 3">S'inscrire</h5>
                    <button type="button" class="btn-close" @click="authFormModalAuthorsUpdateClose" data-bs-dismiss="modal" aria-label="Close"></button>
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
        QuillEditor
    },
    data () {
        return {
            dataReady: 0,
            meRoleName: null,
            authorsUpdateData: {},
            authorsUpdateMessage: null,
            authorsUpdateErrors: [],
            authorsShowData: {},
            authorsShowMessage: null,
            authorsShowErrors: [],
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
            loadingUpdate: false,
            showPsw: false,
            showPswC: false
        }
    },
    computed: {
        ...mapGetters("roleSecurity",{
            gettersMeRoleName:"getMeRoleName",
            gettersRoleStatus:'getRoleStatus',
        }),

        ...mapGetters('authorsPub',{
            getterInfosAuthorsUpdateStatus:'getInfosAuthorsUpdateStatus',
            getterInfosAuthorsUpdateMessage:'getInfosAuthorsUpdateMessage',
            getterInfosAuthorsUpdateErrors:'getInfosAuthorsUpdateErrors',
            getterInfosAuthorsUpdateData:'getInfosAuthorsUpdateData',
            getterInfosAuthorsShowStatus:'getInfosAuthorsShowStatus',
            getterInfosAuthorsShowMessage:'getInfosAuthorsShowMessage',
            getterInfosAuthorsShowErrors:'getInfosAuthorsShowErrors',
            getterInfosAuthorsShowData:'getInfosAuthorsShowData',
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

        ...mapActions("authorsPub",{
          actionsAuthorsUpdateDataRequest:'authorsUpdateDataRequest',
          actionsAuthorsShowDataRequest:'authorsShowDataRequest',
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

        authFormModalAuthorsUpdateClose(){
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.authorsUpdateMessage =  null
            this.authorsUpdateErrors = []
            $('#authFormModalAuthorsUpdate').modal('hide');
        },


        authFormModalAuthorsUpdateShow(action_auth="SHOW"){

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

            this.loadingUpdate = false

            if(this.authSectionModal == "SHOW"){

                this.loadingShow = false

            }else if(this.authSectionModal == "UPDATE"){

                this.loadingUpdate = false

            }

            $('#authFormModalAuthorsUpdate').modal('show');
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

            this.authorsUpdateMessage =  null
            this.authorsUpdateErrors = []
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
            this.authorsUpdateMessage =  null
            this.authorsUpdateErrors = []
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
            this.authorsUpdateMessage =  null
            this.authorsUpdateErrors = []
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
            this.authorsUpdateMessage =  null
            this.authorsUpdateErrors = []
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
            this.authorsUpdateMessage =  null
            this.authorsUpdateErrors = []
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

            if(this.getterLoginStatus === 'success pub'){

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

                    if(this.authSectionModal== 'SHOW'){

                        this.authFormModalAuthorsUpdateClose()

                        this.loadingShow = true

                        this.authorsShow()

                    }else if(this.authSectionModal== 'UPDATE'){


                        this.authFormModalAuthorsUpdateClose()

                        this.loadingUpdate = true

                        this.authorsUpdate()
                    }

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

                    if(this.authSectionModal== 'SHOW'){

                        this.authFormModalAuthorsUpdateClose()

                        this.loadingShow = true

                        this.authorsShow()

                    }else if(this.authSectionModal== 'UPDATE'){

                        this.authFormModalAuthorsUpdateClose()

                        this.loadingUpdate = true

                        this.authorsUpdate()
                    }

                }

            }else if(this.getterLoginStatus === 'success admin'){

                if(this.remember_me){

                    localStorage.setItem('username', this.username )

                    localStorage.setItem('password', this.password)

                    localStorage.setItem('remember_me', true)

                    this.loadingLogin = false

                    window.location = '/admin/dashboard'


                }else{

                    localStorage.setItem('remember_me', false)

                    this.loadingLogin = false

                    window.location = '/admin/dashboard'
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

        async update(){

            this.loadingUpdate = true

            this.authSectionModal= 'UPDATE'

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeRole();

                if(this.gettersRoleStatus === 'success'){

                    this.meRoleName = this.gettersMeRoleName

                    if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbrsp?!')){

                        this.authorsUpdate()

                    }else{

                        this.authFormModalAuthorsUpdateShow('UPDATE')

                    }

                }else if(this.gettersRoleStatus === 'failed'){

                    this.authFormModalAuthorsUpdateShow('UPDATE')
                }

            }else{

                this.authFormModalAuthorsUpdateShow('UPDATE')

            }

        },

        async authorsUpdate(){

            this.loadingUpdate = true

            this.authSectionModal= 'UPDATE'

            this.authorsUpdateMessage =  null
            this.authorsUpdateErrors = []

            await this.actionsAuthorsUpdateDataRequest({ slug : this.$route.params.slug, nom : this.nom, prenoms : this.prenoms, authorName : this.authorName, email : this.email, address : this.address, telephone : this.telephone, description : this.description});

            if( this.getterInfosAuthorsUpdateStatus ==="success"){

                this.authorsUpdateData = this.getterInfosAuthorsUpdateData

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
                    title: this.getterInfosAuthorsUpdateMessage
                })

                this.loadingUpdate = false

                this.authorsUpdateMessage =  null
                this.authorsUpdateErrors = []

            }else if( this.getterInfosAuthorsUpdateStatus ==="empty"){

                this.authorsUpdateMessage = this.getterInfosAuthorsUpdateMessage

                this.authorsUpdateErrors = this.getterInfosAuthorsUpdateErrors

                this.loadingUpdate = false


            }else if( this.getterInfosAuthorsUpdateStatus ==="error"){

                this.authorsUpdateMessage = this.getterInfosAuthorsUpdateMessage

                this.authorsUpdateErrors = []

                this.loadingUpdate = false

            }
        },

        async show(){

            this.loadingShow = true

            this.authSectionModal= 'SHOW'

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeRole();

                if(this.gettersRoleStatus === 'success'){

                    this.meRoleName = this.gettersMeRoleName

                    if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbrsp?!')){

                        this.authorsShow()

                    }else{

                        this.dataReady= 2

                    }

                }else if(this.gettersRoleStatus === 'failed'){

                    this.dataReady = 3;
                }

            }else{

                this.dataReady = 4;

            }

        },

        async authorsShow(){

            this.loadingShow = true

            this.authSectionModal= 'SHOW'

            await this.actionsAuthorsShowDataRequest({slug : this.$route.params.slug});

            if( this.getterInfosAuthorsShowStatus ==="success"){

                this.authorsShowData = this.getterInfosAuthorsShowData

                this.nom = this.getterInfosAuthorsShowData.author.nom

                this.prenoms = this.getterInfosAuthorsShowData.author.prenoms

                this.authorName = this.getterInfosAuthorsShowData.author.authorName

                this.email = this.getterInfosAuthorsShowData.author.email

                this.telephone = this.getterInfosAuthorsShowData.author.telephone

                this.address = this.getterInfosAuthorsShowData.author.address

                this.description = this.getterInfosAuthorsShowData.author.description

                this.slug= this.getterInfosAuthorsShowData.author.slug

                this.authorsUpdateMessage =  null
                this.authorsUpdateErrors = []

                this.empty = 0

                this.dataReady = 1

                this.loadingShow = false

            }else{

                this.empty = 1

                this.dataReady = 1

                this.authorsShowMessage = this.getterInfosAuthorsShowMessage

                this.loadingShow = false

            }
        },

    },
    mounted() {
        this.moment = moment
        this.show()
    },
};
</script>
