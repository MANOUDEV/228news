<template>
    <!-- =======================Author list START -->
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
                            <h1 class="mb-2 mb-sm-0 h2">Mes Tags <span class="badge bg-primary bg-opacity-10 text-primary"> {{ tagsListData.tagsCount  }} </span></h1>
                            <span style="cursor: pointer" @click="authModalClick('CREATE')" class="btn btn-sm btn-primary mb-0"><i class="fas fa-plus me-2"></i>Ajouter un tag</span>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12">
                        <!-- Card START -->
                        <div class="card border">
                            <!-- Card header START -->
                            <div class="card-header border-bottom p-3">
                                <!-- Search and select START -->
                                <div class="row g-3 align-items-center justify-content-between">
                                    <!-- Search bar -->
                                    <div class="col-md-10">
                                        <div class="row" v-if="emptySearchByDate == 0">
                                            <div class="col-md-7">
                                                <form class="rounded position-relative" method="GET" @submit.prevent="getResults">
                                                    <input class="form-control bg-transparent" v-model="search" @input="show" name="search" type="search" placeholder="Rechercher un tag ..." aria-label="Search">
                                                    <button class="btn bg-transparent border-0 px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 "></i></button>
                                                </form>
                                            </div>
                                            <div class="col-md-5">
                                                <form class="rounded position-relative" method="GET" >
                                                    <select class="form-select" @change="handleSelection($event)" v-model="searchH" name="searchH" id="searchH">
                                                        <option value="ALL" >Tous les tags</option>
                                                        <option v-for="(option, index) in searchByDateListData" :key="index" :value="option.date_name">
                                                        {{ option.date_name }}
                                                        </option>
                                                    </select>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row" v-else>
                                            <div class="col-md-12">
                                                <form class="rounded position-relative" method="GET" @submit.prevent="getResults">
                                                    <input class="form-control bg-transparent" v-model="search" @input="show" name="search" type="search" placeholder="Rechercher un tag ..." aria-label="Search">
                                                    <button class="btn bg-transparent border-0 px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 "></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Search bar -->
                                    </div>
                                    <!-- Tab buttons -->
                                    <div class="col-md-2">
                                        <!-- Tabs START -->
                                        <ul class="list-inline mb-0 nav nav-pills nav-pill-dark-soft border-0 justify-content-end" id="pills-tab" role="tablist">

                                             <!-- Grid tab -->
                                            <li class="nav-item">
                                                <a href="#nav-grid-tab" class="nav-link mb-0 me-2 active" data-bs-toggle="tab">
                                                    <i class="fas fa-fw fa-th-large"></i>
                                                </a>
                                            </li>

                                            <!-- List tab -->
                                            <li class="nav-item">
                                                <a href="#nav-list-tab" class="nav-link mb-0" data-bs-toggle="tab">
                                                    <i class="fas fa-fw fa-list-ul"></i>
                                                </a>
                                            </li>

                                        </ul>
                                        <!-- Tabs end -->
                                    </div>
                                </div>
                                <!-- Search and select END -->
                            </div>
                            <!-- Card header END -->
                            <div class="card-body p-3 pb-0" v-if="empty == 0">
                                <div class="tab-content py-0 my-0">

                                    <!-- Tabs content item START -->
                                    <div class="tab-pane fade" id="nav-list-tab">
                                        <!-- Table START -->
                                        <div class="table-responsive border-0">
                                            <table class="table align-middle p-4 mb-0 table-hover">
                                                <!-- Table head -->
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th scope="col" class="border-0 rounded-start">Tag</th>
                                                        <th scope="col" class="border-0">Publications</th>
                                                        <th scope="col" class="border-0">Ajouté le</th>
                                                        <th scope="col" class="border-0">Actions</th>
                                                    </tr>
                                                </thead>

                                                <!-- Table body START -->
                                                <tbody class="border-top-0">
                                                    <!-- Table row -->
                                                    <tr v-for="result in tagsListData.tags.data" :key="result.id">

                                                        <!-- Table data -->
                                                        <th> {{ result.name }} </th>
                                                        <!-- Table data -->
                                                        <td>
                                                            <span v-if="result.count_publications === 0" class="badge bg-danger bg-opacity-10 text-danger mb-2">Aucune publication</span>
                                                            <span v-else-if="result.count_publications == 1" class="badge bg-success bg-opacity-10 text-white-force mb-2">1 publication</span>
                                                            <span v-else class="badge bg-success bg-opacity-10 text-white-force mb-2"> {{ result.count_publications }} publications</span>
                                                        </td>
                                                        <!-- Table data -->
                                                        <td>{{ moment(result.date_publish).format("DD/MM/YYYY") }}</td>
                                                        <!-- Table data -->

                                                        <!-- Table data -->
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <span style="cursor: pointer" @click="authModalClick('UPDATE',result.name, result.slug )" class="btn btn-primary btn-round mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Message" aria-label="Message">
                                                                <i class="bi bi-pencil-fill"></i>
                                                                </span>
                                                                <span @click="authModalClick('DELETE',result.name, result.slug )" class="btn btn-danger btn-round mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Block" aria-label="Block">
                                                                    <i class="fas fa-trash"></i>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                     <!-- Tabs content item START -->
                                    <div class="tab-pane fade show active" id="nav-grid-tab">
                                        <div class="row g-4">
                                            <div class="col-md-6 col-xl-4" v-for="result in tagsListData.tags.data" :key="result.id">
                                                <!-- tags item START -->
                                                <div class="card border h-100">
                                                    <!-- Card header -->
                                                    <div class="card-header border-bottom p-3">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mb-0 ms-3"> {{ result.name }} </h5>
                                                        </div>
                                                    </div>

                                                    <!-- Card body START -->
                                                    <div class="card-body p-3">
                                                        <p> ajouté le {{ moment(result.date_publish).format("DD/MM/YYYY") }} </p>

                                                        <!-- Followers and Post -->
                                                        <div class="d-sm-flex justify-content-sm-between mt-3">
                                                            <div class="d-flex text-start align-items-center mt-3">
                                                                <div class="icon-md bg-success text-light rounded-circle flex-shrink-0">
                                                                    <i class="bi bi-file-earmark-text-fill fa-fw"></i>
                                                                </div>
                                                                <div class="ms-2" v-if="result.count_publications === 0">
                                                                    <h5 class="mb-0">Aucune</h5>
                                                                    <h6 class="mb-0 fw-light">publication</h6>
                                                                </div>

                                                                <div class="ms-2" v-else-if="result.count_publications === 1">
                                                                    <h5 class="mb-0">1</h5>
                                                                    <h6 class="mb-0 fw-light">publication</h6>
                                                                </div>

                                                                <div class="ms-2" v-else>
                                                                    <h5 class="mb-0">{{ result.count_publications }}</h5>
                                                                    <h6 class="mb-0 fw-light">publications</h6>
                                                                </div>
                                                            </div>

                                                            <!-- Total post -->
                                                            <div class="d-flex text-start align-items-center mt-3">
                                                                <div style="cursor: pointer" @click="authModalClick('UPDATE',result.name, result.slug )" class="icon-md bg-primary text-white-force rounded-circle flex-shrink-0">
                                                                    <i class="bi bi-pencil-fill"></i>
                                                                </div>
                                                                &nbsp;
                                                                <div style="cursor: pointer" @click="authModalClick('DELETE',result.name, result.slug )" class="icon-md bg-danger text-white-force rounded-circle flex-shrink-0">
                                                                    <i class="bi bi-trash"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Card body END -->

                                                    <!-- Card footer -->
                                                    <div class="card-footer border-top text-center p-3">
                                                        <a href="#" class="btn btn-primary-soft w-100 mb-0">Voir les publications</a>
                                                    </div>
                                                </div>
                                                <!-- tags item END -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3 pb-0" v-else-if="empty == 1">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                      <div style="position: relative; height: 250px;">
                                          <img src="https://actualitetogo.com/assets/images/empty.png" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                                      </div>
                                      <h5 style="text-align: center; margin-top: -50px"> {{ tagsListMessage  }} </h5>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>

                            <div class="card-footer p-3" v-if="empty == 0">
                                <!-- Pagination START -->
                                <div class="d-sm-flex justify-content-sm-between align-items-sm-center">

                                    <Bootstrap5Pagination
                                        class="mb-0"
                                        :data="tagsListData.tags"
                                        :limit="limit"
                                        :keep-length="keepLength"
                                        :show-disabled="showDisabled"
                                        :size="size"
                                        :align="align"
                                        @pagination-change-page="getResults"
                                    />

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
                                <span style="cursor: pointer"  @click="authModalClick('LIST')" class="btn btn-danger-soft mt-3"><i class="fas fa-long-arrow-alt-left me-3"></i>Se connecter</span>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- Modal Form -->
    <div class="modal fade" id="authFormModalTagsList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" v-if="authSectionModal == 'CREATE'">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un tag</h5>
                    <button type="button" class="btn-close" @click="authFormModalTagsListClose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div v-if="tagsStoreMessage">
                            <div class="alert alert-danger"  role="alert">
                                {{ tagsStoreMessage }}
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3" v-if="tagsStoreErrors.name">
                            <label class="form-label" for="exampleInputEmailTagsCreate">Nom du tag</label>
                            <input type="text" v-model="name" name="name" class="form-control is-invalid" id="exampleInputEmailTagsCreate" placeholder="Entrez le nom du tag">
                            <div v-for="errorname in tagsStoreErrors.name" :key="errorname" class="invalid-feedback">
                                {{ errorname }}
                            </div>
                        </div>
                        <div class="mb-3" v-else>
                            <label class="form-label" for="exampleInputEmailLoginInvalid">Nom du tag</label>
                            <input type="text" v-model="name" name="name" class="form-control" id="exampleInputEmailTagsCreate" placeholder="Entrez le nom du tag">
                        </div>
                    </div>
                    <div class="modal-footer" >
                        <div  v-if="!loadingCreate" style="margin-top: -5px; margin-bottom: -10px">
                            <button type="submit" @click.prevent="create" class="btn btn-primary">Ajouter</button>
                            &nbsp;
                            <span><span class="btn btn-danger" @click="authFormModalTagsListClose">Fermez</span></span>
                        </div>
                        <div style="margin-top: -5px; margin-bottom: -10px" v-else>
                            <button type="button" disabled class="btn btn-primary   mx-auto w-100">
                                <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                <span class="sr-only">Loading...</span> Ajout en cours ...
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-content" v-if="authSectionModal == 'UPDATE'">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier un tag</h5>
                    <button type="button" class="btn-close" @click="authFormModalTagsListClose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div v-if="tagsUpdateMessage">
                            <div class="alert alert-danger"  role="alert">
                                {{ tagsUpdateMessage }}
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3" v-if="tagsUpdateErrors.name">
                            <label class="form-label" for="exampleInputEmailTagCreate">Nom du tag</label>
                            <input type="text" v-model="name" name="name" class="form-control is-invalid" id="exampleInputEmailtagsCreate" placeholder="Entrez le nom du tag">
                            <div v-for="errorname in tagsUpdateErrors.name" :key="errorname" class="invalid-feedback">
                                {{ errorname }}
                            </div>
                        </div>
                        <div class="mb-3" v-else>
                            <label class="form-label" for="exampleInputEmailLoginInvalid">Nom du tag</label>
                            <input type="text" v-model="name" name="name" class="form-control" id="exampleInputEmailtagsCreate" placeholder="Entrez le nom du tag">
                        </div>
                    </div>
                    <div class="modal-footer" >
                        <div  v-if="!loadingUpdate" style="margin-top: -5px; margin-bottom: -10px">
                            <button type="submit" @click.prevent="update" class="btn btn-primary">Modifier</button>
                            &nbsp;
                            <span><span class="btn btn-danger" @click="authFormModalTagsListClose">Fermez</span></span>
                        </div>
                        <div style="margin-top: -5px; margin-bottom: -10px" v-else>
                            <button type="button" disabled class="btn btn-primary   mx-auto w-100">
                                <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                <span class="sr-only">Loading...</span> Modification en cours ...
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-content" v-if="authSectionModal == 'DELETE'">

                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <i class="bi bi-info-circle fa-fw me-2" style="font-size: 80px; color: blue"></i>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h6>ATTENTION</h6>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="text-center">Toutes données relatives à ce tag seront aussi supprimées.</p>
                    </div>
                    <div class="d-flex justify-content-center" v-if="!loadingDelete" style="margin-top: -5px; margin-bottom: -10px">
                        <span style="cursor: pointer" @click.prevent="destroy" class="btn btn-danger">Supprimez</span>
                        &nbsp;
                        <span><span class="btn btn-success" @click="authFormModalTagsListClose">Annuler</span></span>
                    </div>
                    <div class="d-flex justify-content-center" style="margin-top: -5px; margin-bottom: -10px" v-else>
                        <button type="button" disabled class="btn btn-primary   mx-auto w-100">
                            <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                            <span class="sr-only">Loading...</span> Suppression en cours ...
                        </button>
                    </div>
                </div>

            </div>
                <!-- Login Form -->
            <div class="modal-content" v-else-if="authSectionModal == 'DELETE_AUTH' || authSectionModal == 'UPDATE_AUTH' || authSectionModal == 'CREATE_AUTH' || authSectionModal == 'LIST'">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="authSectionStepModal == 1">Se connecter</h5>
                    <h5 class="modal-title" v-else-if="authSectionStepModal == 2">Modifier le mot de passe</h5>
                    <h5 class="modal-title" v-else-if="authSectionStepModal == 3">S'inscrire</h5>
                    <button type="button" class="btn-close" @click="authFormModalTagsListClose" data-bs-dismiss="modal" aria-label="Close"></button>
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
export default {
    // inside your script
    components: {
        Bootstrap5Pagination,
        TailwindPagination,
    },
    data () {
        return {
            dataReady: 0,
            meRoleName: null,
            tagsListData: {},
            tagsListMessage: null,
            tagsStoreData: {},
            searchByDateListData: {},
            searchByDateListMessage: null,
            tagsStoreMessage: null,
            tagsStoreErrors: [],
            tagsUpdateData: {},
            tagsUpdateMessage: null,
            tagsUpdateErrors: [],
            tagsDeleteData: {},
            tagsDeleteMessage: null,
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
            name: null,
            slug: null,
            loadingCreate: false,
            loadingUpdate: false,
            loadingDelete: false,
            showPsw: false,
            showPswC: false,
            searchH:"ALL",
            emptySearchByDate: 0
        }
    },
    computed: {
        ...mapGetters("roleSecurity",{
            gettersMeRoleName:"getMeRoleName",
            gettersRoleStatus:'getRoleStatus',
        }),

        ...mapGetters('tagsPub',{
            getterInfosTagsListStatus:'getInfosTagsListStatus',
            getterInfosTagsListMessage:'getInfosTagsListMessage',
            getterInfosTagsListData:'getInfosTagsListData',
            getterInfosSearchByDateListStatus:'getInfosSearchByDateListStatus',
            getterInfosSearchByDateListMessage:'getInfosSearchByDateListMessage',
            getterInfosSearchByDateListData:'getInfosSearchByDateListData',
            getterInfosTagsStoreStatus:'getInfosTagsStoreStatus',
            getterInfosTagsStoreMessage:'getInfosTagsStoreMessage',
            getterInfosTagsStoreErrors:'getInfosTagsStoreErrors',
            getterInfosTagsStoreData:'getInfosTagsStoreData',
            getterInfosTagsUpdateStatus:'getInfosTagsUpdateStatus',
            getterInfosTagsUpdateMessage:'getInfosTagsUpdateMessage',
            getterInfosTagsUpdateErrors:'getInfosTagsUpdateErrors',
            getterInfosTagsUpdateData:'getInfosTagsUpdateData',
            getterInfosTagsDeleteStatus:'getInfosTagsDeleteStatus',
            getterInfosTagsDeleteMessage:'getInfosTagsDeleteMessage',
            getterInfosTagsDeleteData:'getInfosTagsDeleteData',
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

        ...mapActions("tagsPub",{
          actionsTagsListDataRequest:'tagsListDataRequest',
          actionsSearchByDateListDataRequest:'searchByDateListDataRequest', 
          actionsTagsListHDataRequest:'tagsListHDataRequest',
          actionsTagsStoreDataRequest:'tagsStoreDataRequest',
          actionsTagsUpdateDataRequest:'tagsUpdateDataRequest',
          actionsTagsDeleteDataRequest:'tagsDeleteDataRequest'
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

        authFormModalTagsListClose(){
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.tagsUpdateMessage =  null
            this.tagsUpdateErrors = []
            this.tagsStoreMessage =  null
            this.tagsStoreErrors = []
            $('#authFormModalTagsList').modal('hide');
        },


        authModalClick(action_auth="LIST", name=null, slug=null){

            if(localStorage.getItem('remember_me') == true && localStorage.getItem('username') && localStorage.getItem('password')){

                this.username = localStorage.getItem('username')

                this.password = localStorage.getItem('password')

                this.remember_me = localStorage.getItem('remember_me')
            }

            this.name = name

            this.slug = slug

            this.authSectionModal= action_auth

            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.tagsUpdateMessage =  null
            this.tagsUpdateErrors = []
            this.tagsStoreMessage =  null
            this.tagsStoreErrors = []

            if(this.authSectionModal == "CREATE"){

                this.loadingCreate = false

            }else if(this.authSectionModal == "UPDATE"){

                this.loadingUpdate = false

            }else if(this.authSectionModal == "DELETE"){

                this.loadingDelete = false

            }

            $('#authFormModalTagsList').modal('show');
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
            this.tagsUpdateMessage =  null
            this.tagsUpdateErrors = []
            this.tagsStoreMessage =  null
            this.tagsStoreErrors = []
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
            this.tagsUpdateMessage =  null
            this.tagsUpdateErrors = []
            this.tagsStoreMessage =  null
            this.tagsStoreErrors = []
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
            this.tagsUpdateMessage =  null
            this.tagsUpdateErrors = []
            this.tagsStoreMessage =  null
            this.tagsStoreErrors = []
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
            this.tagsUpdateMessage =  null
            this.tagsUpdateErrors = []
            this.tagsStoreMessage =  null
            this.tagsStoreErrors = []
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



                    if(this.authSectionModal== 'LIST'){

                        this.authFormModalTagsListClose()

                        this.getResults()

                    }else if(this.authSectionModal == "CREATE_AUTH"){

                        this.authSectionModal = "CREATE"

                        this.tagsCreate()

                    }else if(this.authSectionModal == "UPDATE_AUTH"){

                        this.authSectionModal = "UPDATE"

                        this.tagsUpdate()

                    }else if(this.authSectionModal == "DELETE_AUTH"){

                        this.authSectionModal = "DELETE"

                        this.tagsDelete()

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




                   if(this.authSectionModal== 'LIST'){

                        this.authFormModalTagsListClose()

                        this.getResults()

                    }else if(this.authSectionModal == "CREATE_AUTH"){

                        this.authSectionModal = "CREATE"

                        this.tagsCreate()

                    }else if(this.authSectionModal == "UPDATE_AUTH"){

                        this.authSectionModal = "UPDATE"

                        this.tagsUpdate()

                    }else if(this.authSectionModal == "DELETE_AUTH"){

                        this.authSectionModal = "DELETE"

                        this.tagsDelete()

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

        async show(){

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeRole();

                this.authSectionModal= 'LIST'

                if(this.gettersRoleStatus === 'success'){

                    this.meRoleName = this.gettersMeRoleName

                    if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbrsp?!')){

                        this.getResults()

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


        async getResults(page = 1){

            this.loading = true

            this.authSectionModal= 'LIST'

            await this.actionsTagsListDataRequest({ page : page, search: this.search});

            if( this.getterInfosTagsListStatus ==="success"){

                this.tagsListData = this.getterInfosTagsListData

                this.getResultsSearchByDate()

                this.empty = 0

                this.dataReady = 1

                this.authFormModalTagsListClose()

            }else if( this.getterInfosTagsListStatus ==="empty"){

                this.tagsListMessage = this.getterInfosTagsListMessage

                this.tagsListData = this.getterInfosTagsListData

                this.empty = 1

                this.dataReady = 1

            }else if(this.getterInfosTagsListStatus === 'failed'){

                this.dataReady = 3;

            }else{

                this.tagsListMessage = this.getterInfosTagsListMessage

                this.empty = 3

                this.dataReady = 4

            }
        },

         async getResultsSearchByDate( ){

            await this.actionsSearchByDateListDataRequest({  });

            if( this.getterInfosSearchByDateListStatus ==="success"){

                this.searchByDateListData = this.getterInfosSearchByDateListData

                this.emptySearchByDate = 0

            }else if( this.getterInfosSearchByDateListStatus ==="empty"){

                this.emptySearchByData = 1

            }
        },

        async handleSelection(event, page=1){
            this.searchH = event.target.value

            this.authSectionModal= 'LIST'

            await this.actionsTagsListHDataRequest({ page : page, searchH: this.searchH});

            if( this.getterInfosTagsListStatus ==="success"){

                this.tagsListData = this.getterInfosTagsListData

                this.getResultsSearchByDate( )

                this.empty = 0

                this.dataReady = 1

                this.authFormModalTagsListClose()

            }else if( this.getterInfosTagsListStatus ==="empty"){

                this.tagsListMessage = this.getterInfosTagsListMessage

                this.tagsListData = this.getterInfosTagsListData

                this.empty = 1

                this.dataReady = 1

            }else if(this.getterInfosTagsListStatus === 'failed'){

                this.dataReady = 3;

            }else{

                this.tagsListMessage = this.getterInfosTagsListMessage

                this.empty = 3

                this.dataReady = 4

            }
        },

        async create(){

            this.loadingCreate = true

            this.authSectionModal= 'CREATE'

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeRole();

                if(this.gettersRoleStatus === 'success'){

                    this.meRoleName = this.gettersMeRoleName

                    if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbrsp?!')){

                        this.tagsCreate()

                    }else{

                        this.loadingCreate = true

                        //this.authSectionModal= 'CREATE'

                    }

                }else if(this.gettersRoleStatus === 'failed'){

                    this.authSectionModal= 'CREATE_AUTH'
                }

            }else{

                this.authSectionModal= 'CREATE_AUTH'

            }

        },

        async tagsCreate(){

            this.loadingCreate = true

            this.authSectionModal= 'CREATE'

            this.tagsStoreMessage =  null
            this.tagsStoreErrors = []

            await this.actionsTagsStoreDataRequest({ name : this.name});

            if( this.getterInfosTagsStoreStatus ==="success"){

                this.tagsStoreData = this.getterInfosTagsStoreData

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
                    title: this.getterInfosTagsStoreMessage
                })

                this.loadingCreate = false

                this.name = null

                this.slug= null

                this.tagsStoreMessage =  null
                this.tagsStoreErrors = []

                this.authFormModalTagsListClose()

                this.getResults()

            }else if( this.getterInfosTagsStoreStatus ==="empty"){

                this.tagsStoreMessage = this.getterInfosTagsStoreMessage

                this.tagsStoreErrors = this.getterInfosTagsStoreErrors

                this.loadingCreate = false


            }else if( this.getterInfosTagsStoreStatus ==="error"){

                this.tagsStoreMessage = this.getterInfosTagsStoreMessage

                this.tagsStoreErrors = []

                this.loadingCreate = false

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

                        this.tagsUpdate()

                    }else{

                        this.loadingUpdate = true

                        //this.authSectionModal= 'CREATE'

                    }

                }else if(this.gettersRoleStatus === 'failed'){

                    this.authSectionModal= 'UPDATE_AUTH'
                }

            }else{

                this.authSectionModal= 'UPDATE_AUTH'

            }

        },

        async tagsUpdate(){

            this.loadingUpdate = true

            this.authSectionModal= 'UPDATE'

            this.tagsUpdateMessage =  null
            this.tagsUpdateErrors = []

            await this.actionsTagsUpdateDataRequest({ name : this.name, slug : this.slug,});

            if( this.getterInfosTagsUpdateStatus ==="success"){

                this.tagsUpdateData = this.getterInfosTagsUpdateData

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
                    title: this.getterInfosTagsUpdateMessage
                })

                this.loadingUpdate = false

                this.tagsUpdateMessage =  null
                this.tagsUpdateErrors = []

                this.name = null

                this.slug= null

                this.authFormModalTagsListClose()

                this.getResults()

            }else if( this.getterInfosTagsUpdateStatus ==="empty"){

                this.tagsUpdateMessage = this.getterInfosTagsUpdateMessage

                this.tagsUpdateErrors = this.getterInfosTagsUpdateErrors

                this.loadingUpdate = false


            }else if( this.getterInfosTagsUpdateStatus ==="error"){

                this.tagsUpdateMessage = this.getterInfosTagsUpdateMessage

                this.tagsUpdateErrors = []

                this.loadingUpdate = false

            }
        },

        async destroy(){

            this.loadingDelete = true

            this.authSectionModal= 'DELETE'

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeRole();

                if(this.gettersRoleStatus === 'success'){

                    this.meRoleName = this.gettersMeRoleName

                    if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbrsp?!')){

                        this.tagsDelete()

                    }else{

                        this.loadingDelete = true

                        //this.authSectionModal= 'CREATE'

                    }

                }else if(this.gettersRoleStatus === 'failed'){

                    this.authSectionModal= 'DELETE_AUTH'
                }

            }else{

                this.authSectionModal= 'DELETE_AUTH'

            }

        },

        async tagsDelete(){

            this.loadingDelete = true

            this.authSectionModal= 'DELETE'

            await this.actionsTagsDeleteDataRequest({slug : this.slug});

            if( this.getterInfosTagsDeleteStatus ==="success"){

                this.tagsDeleteData = this.getterInfosTagsDeleteData

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
                    title: this.getterInfosTagsDeleteMessage
                })

                this.loadingDelete = false

                this.name = null

                this.slug= null

                this.authFormModalTagsListClose()

                this.getResults()

            }else if( this.getterInfosTagsDeleteStatus ==="empty"){

                this.tagsDeleteMessage = this.getterInfosTagsDeleteMessage

                this.tagsDeleteErrors = this.getterInfosTagsDeleteErrors

                this.loadingDelete = false


            }else if( this.getterInfosTagsDeleteStatus ==="error"){

                this.tagsDeleteMessage = this.getterInfosTagsDeleteMessage

                this.loadingDelete = false

            }
        },

    },
    mounted() {
        this.moment = moment
        this.show();
    },
};
</script>
