<template>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border">

                <!-- Card body START -->
                <div class="card-body p-3 pb-0">
                    <div v-if="publicationStorePublicitesCreateMessage">
                        <div class="alert alert-danger"  role="alert">
                            {{ publicationStorePublicitesCreateMessage }}
                        </div>
                    </div>

                    <form>
                        <div class="row" v-if="stepStorePublicitesFirstState">
                            <div class="col-md-12">
                                <!-- Message -->
                                <div class="mb-3">
                                    <label class="form-label" >Titre de la publication</label>
                                    <QuillEditor theme="snow"  v-model:content="title" contentType="html" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" >Lien de la publication</label>
                                    <input type="text" class="form-control  " v-model="link_publicites" name="authorName" placeholder="Entrez le lien de la publicité">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2" >
                                <button type="button" @click="cancelFirst" class="btn btn-danger border-0 me-2">Annuler</button>
                                <button type="submit"  @click="stepStorePublicitesFirstToTwoButton" class="btn btn-primary">Suivant <i class="fa fa-angle-right"></i></button>
                            </div>
                        </div>
                        <div   v-if="stepStorePublicitesTwoState">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-6 ">
                                    <div class="d-flex flex-wrap gap-3" >
                                        <!-- Post type item -->
                                        <div class="flex-fill" @click="UploadState"  >
                                            <input type="radio" class="btn-check"  name="poll" id="option" checked>
                                            <label class="btn btn-outline-light w-100" for="option">
                                                <i class="bi bi-card-image fs-1"></i>
                                                <span class="d-block">Téléchargez</span>
                                            </label>
                                        </div>
                                        <!-- Post type item -->
                                        <div class="flex-fill" @click="LinkState"  >
                                            <input type="radio" class="btn-check" name="poll" id="option2">
                                            <label class="btn btn-outline-light w-100" for="option2">
                                                <i class="bi bi-link-45deg fs-1"></i>
                                                <span class="d-block">URL fichiers</span>
                                            </label>
                                        </div>
                                        <!-- Post type item -->
                                        <div class="flex-fill"  @click="IframeState">
                                            <input type="radio" class="btn-check" name="poll" id="option3" >
                                            <label class="btn btn-outline-light w-100" for="option3">
                                                <i class="bi bi-file-earmark-code fs-1"></i>
                                                <span class="d-block">Code Iframe </span>
                                            </label>
                                        </div>
                                        <!-- Post type item -->
                                        <div class="flex-fill"  @click="ExistState">
                                            <input type="radio" class="btn-check" name="poll" id="option4">
                                            <label class="btn btn-outline-light w-100" for="option4">
                                                <i class="bi bi-cloud-plus fs-1"></i>
                                                <span class="d-block">Mes Fichiers</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  mt-2">
                                    <form  v-if="IframeStateButton">
                                        <!-- Chart START -->
                                        <div class="card border ">

                                            <!-- Card header -->
                                            <div class="card-header p-3 border-bottom">
                                                <h5 class="card-header-title mb-0">Intégrez un code iframe</h5>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body" style="height: 398px">
                                                <div class="col-lg-12 mt-3"  v-if="manageFilesPubStoreCreateErrors.file_name">
                                                    <label class="form-label" >Non du fichier</label>
                                                    <input  name="file_name" v-model="file_name" type="text" class="form-control" placeholder="Veuillez entrer le nom du fichier">
                                                </div>

                                                <div class="col-lg-12 mt-3"  v-else>
                                                    <label class="form-label" >Non du fichier</label>
                                                    <input  name="file_name" v-model="file_name" type="text" class="form-control" placeholder="Veuillez entrer le nom du fichier">
                                                </div>
                                                <div class="col-lg-12 mt-3"  v-if="manageFilesPubStoreCreateErrors.file_url">
                                                    <label class="form-label" >Code Iframe</label>
                                                    <textarea  cols="3" rows="3" name="file_url" v-model="file_url" type="url" class="form-control"  ></textarea>
                                                </div>

                                                <div class="col-lg-12 mt-3"  v-else>
                                                    <label class="form-label" >Code Iframe</label>
                                                    <textarea  cols="3" rows="3" name="file_url" v-model="file_url" type="url" class="form-control"  ></textarea>
                                                </div>
                                                <div class="col-lg-12 mt-3"  v-if="manageFilesPubStoreCreateErrors.description_file">
                                                    <label class="form-label" >Ajoutez une description au fichier</label>
                                                    <input  name="description_file" v-model="description_file" type="text" class="form-control" placeholder="Veuillez décrire le fichier">
                                                </div>

                                                <div class="col-lg-12 mt-3"  v-else>
                                                    <label class="form-label" >Ajoutez une description au fichier</label>
                                                    <input  name="description_file" v-model="description_file" type="text" class="form-control" placeholder="Veuillez décrire le fichier">
                                                </div>
                                                <div class="d-flex justify-content-end mt-4"  >
                                                    <button type="button"   class="btn btn-danger border-0 me-2">Annuler</button>
                                                    <button type="submit"    class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form   v-if="LinkStateButton">
                                        <div class="card border ">

                                            <!-- Card header -->
                                            <div class="card-header p-3 border-bottom">
                                                <h5 class="card-header-title mb-0">Intégrez l'url d'un fichier</h5>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body" style="height: 398px">
                                                <div class="col-lg-12 mt-3"  v-if="manageFilesPubStoreCreateErrors.file_name">
                                                    <label class="form-label" >Non du fichier</label>
                                                    <input  name="file_name" v-model="file_name" type="text" class="form-control" placeholder="Veuillez entrer le nom du fichier">
                                                </div>

                                                <div class="col-lg-12 mt-3"  v-else>
                                                    <label class="form-label" >Non du fichier</label>
                                                    <input  name="file_name" v-model="file_name" type="text" class="form-control" placeholder="Veuillez entrer le nom du fichier">
                                                </div>
                                                <div class="col-lg-12 mt-3"  v-if="manageFilesPubStoreCreateErrors.file_url">
                                                    <label class="form-label" >URL fichier</label>
                                                    <input  name="file_url" v-model="file_url" type="url" class="form-control" placeholder="Veuillez entrer le lien du fichier">
                                                </div>

                                                <div class="col-lg-12 mt-3"  v-else>
                                                    <label class="form-label" >URL fichier</label>
                                                    <input  name="file_url" v-model="file_url" type="url" class="form-control" placeholder="Veuillez entrer le lien du fichier">
                                                </div>
                                                <div class="col-lg-12 mt-3"  v-if="manageFilesPubStoreCreateErrors.description_file">
                                                    <label class="form-label" >Ajoutez une description au fichier</label>
                                                    <input  name="description_file" v-model="description_file" type="text" class="form-control" placeholder="Veuillez décrire le fichier">
                                                </div>

                                                <div class="col-lg-12 mt-3"  v-else>
                                                    <label class="form-label" >Ajoutez une description au fichier</label>
                                                    <input  name="description_file" v-model="description_file" type="text" class="form-control" placeholder="Veuillez décrire le fichier">
                                                </div>
                                                <div class="d-flex justify-content-end mt-4"  >
                                                    <button type="button"   class="btn btn-danger border-0 me-2">Annuler</button>
                                                    <button type="submit"    class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                    <form v-if="ExistStateButton">
                                        <div v-if=" loadingFiles == false">
                                            <div class="col-lg-12 mb-3" >
                                                <div class="card border ">
                                                    <!-- Card header -->
                                                    <div class="card-header border-bottom p-3">
                                                        <div class="row g-3 align-items-center justify-content-between">
                                                            <!-- Search bar -->
                                                            <div class="col-md-8">
                                                                <form class="rounded position-relative" method="GET" @submit.prevent="getFiles">
                                                                    <input class="form-control bg-transparent" v-model="search" @input="getFiles" name="search" type="search" placeholder="Rechercher un fichier ..." aria-label="Search">
                                                                    <button class="btn bg-transparent border-0 px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 "></i></button>
                                                                </form>
                                                            </div>
                                                            <!-- Tab buttons -->
                                                            <div class="col-md-4">
                                                                <form class="rounded position-relative" method="GET" >
                                                                    <select class="form-select" @change="handleSelectionSearchByStatusFiles($event)" v-model="statusFiles" name="statusFiles" id="statusFiles">
                                                                        <option value="3" >Tous les fichiers</option>
                                                                        <option value="1" >Les images</option>
                                                                        <option value="2" >Les videos</option>
                                                                    </select>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-3" v-if="emptyFiles == 0" style="height: 301px; overflow-y: scroll;">
                                                        <div class="row g-3" >
                                                            <div class=" col-6 col-sm-6 col-lg-4" v-for="result in filesData.files.data" :key="result.id">
                                                                <div class="card bg-transparent" v-if="result.type_file_id == 1">
                                                                    <!-- Card img -->
                                                                    <img @click="selectFiles(result.file_name, result.type_file_id, result.file_url)" class="card-img rounded files_select" :src='getImage(result.file_url)' >

                                                                </div>
                                                                <div class="card bg-transparent" v-else-if="result.type_file_id == 2">
                                                                    <!-- Card img -->
                                                                    <video @click="selectFiles(result.file_name, result.type_file_id, result.file_url)" class="card-img rounded" muted :src='getImage(result.file_url)' style="height: 127px; object-fit: cover; cursor:pointer"  ></video>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-3 pb-0" v-else-if="emptyFiles == 1">
                                                        <div class="row">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-6">
                                                              <div style="position: relative; height: 250px;">
                                                                  <img src="https://togoactu.com/assets/images/empty.png" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                                                              </div>
                                                              <h5 style="text-align: center; margin-top: -50px"> {{ filesMessage  }} </h5>
                                                            </div>
                                                            <div class="col-md-3"></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer p-3" v-if="empty == 0">
                                                        <!-- Pagination START -->
                                                        <div class="d-sm-flex justify-content-sm-between align-items-sm-center">

                                                            <Bootstrap5Pagination
                                                                class="mb-0"
                                                                :data="filesData.files"
                                                                :limit="limit"
                                                                :keep-length="keepLength"
                                                                :show-disabled="showDisabled"
                                                                :size="size"
                                                                :align="align"
                                                                @pagination-change-page="getFiles"
                                                            />

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </form>
                                    <form v-if="UploadStateButton">

                                        <div class="col-lg-12 mt-1" >
                                            <div class="file-upload">
                                                <input type="file" name="files" class="file-input" multiple>
                                                <div class="icon text-center">
                                                    <i   class="fa fa-arrow-up arrow" aria-hidden="true"></i>
                                                </div>
                                                <h3 class="text-center">Glissez et déposer vos fichiers ici</h3>
                                                <span>-OU-</span>
                                                <strong>Cliquez ici</strong>
                                                <button>
                                                    <i  class="fas fa-plus .plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12  mt-2">
                                    <!-- Chart START -->
                                    <div class="card border  ">

                                        <!-- Card header -->
                                        <div class="card-header p-3 border-bottom">
                                            <h5 class="card-header-title mb-0">Mes fichiers</h5>
                                        </div>
                                        <!-- Card body -->
                                        <div class="card-body" style="height: 380px; overflow-y: scroll;">
                                            <div class="row" v-if="files_selected.length == 0">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                  <div style="position: relative; height: 250px;">
                                                      <img src="https://togoactu.com/assets/images/empty.png" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                                                  </div>
                                                  <h5 style="text-align: center; margin-top: -50px"> Ancun fichier n'a été uploadé  pour le moment. </h5>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                            <div class="row" v-else>
                                                <!-- Blog item -->
                                                <div v-for="info in files_selected" :key="info.file_name">

                                                    <div class="card">
                                                        <div class="row g-3">
                                                            <div class="col-5">
                                                                <img class="rounded-3" style="height: 60px" v-if="info.type_file_id == 1" :src='getImage(info.file_url)'>
                                                                <video class="rounded-3" style="height: 60px" muted v-else-if="info.type_file_id == 2" :src='getImage(info.file_url)'  ></video >
                                                            </div>
                                                            <div class="col-7">
                                                                <h6><span class="  text-reset fw-bold" v-html="info.file_name"></span></h6>
                                                                <!-- Card info -->
                                                                <ul class="nav nav-divider align-items-center  small mt-2">
                                                                    <li class="nav-item">
                                                                        <span   style="cursor: pointer" class="text-reset btn-link">Modifier</span>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <span @click="removeFiles(info)" style="cursor: pointer" class="text-reset btn-link">Retirer</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-3">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chart END -->
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4"  >
                                <button type="button" @click="stepStorePublicitesTwoToFirstButton" class="btn btn-danger border-0 me-2"><i class="fa fa-angle-left"></i>Précédent</button>
                                <button type="submit"  @click="stepStorePublicitesTwoToThreeButton" class="btn btn-primary">Suivant<i class="fa fa-angle-right"></i></button>
                            </div>
                        </div>
                        <div  v-if="stepStorePublicitesThreeState">
                            <div class="row">
                                <div class="col-xl-4">
                                    <!-- Chart START -->
                                    <div class="card border h-100">

                                        <!-- Card header -->
                                        <div class="card-header p-3 border-bottom">
                                            <h5 class="card-header-title mb-0">Définir une image de couverture</h5>
                                        </div>
                                        <!-- Card body -->
                                        <div class="card-body p-3"  style="height: 400px; overflow-y: scroll;" v-if="images_og.length != 0">
                                            <div class="row g-3" >
                                                <div class="col-sm-12 col-lg-12" v-for="result in images_og" :key="result ">
                                                    <div class="card bg-transparent" v-if="result.type_file_id == 1">
                                                        <!-- Card img -->
                                                        <img @click="selectFilesOg(result.file_name, result.type_file_id, result.file_url)" class="card-img rounded" :src='getImage(result.file_url)' style="height: 230px; object-fit: cover;  cursor:pointer"  >

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 pb-0" v-else >
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                <div style="position: relative; height: 250px;">
                                                    <img src="https://togoactu.com/assets/images/empty.png" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                                                </div>
                                                <h5 style="text-align: center; margin-top: -50px">Aucun fichier n'est disponible pour l'instant</h5>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chart END -->
                                </div>
                                <div class="col-xl-8">
                                    <!-- Chart START -->
                                    <div class="card border h-100">

                                        <!-- Card header -->
                                        <div class="card-header p-3 border-bottom">
                                            <h5 class="card-header-title mb-0">Votre image de couverture</h5>
                                        </div>
                                        <!-- Card body -->
                                        <div class="card-body" style="height: 400px; overflow-y: scroll;">
                                            <div class="row" v-if="!og_file_url">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                <div style="position: relative; height: 250px;">
                                                    <img src="https://togoactu.com/assets/images/empty.png" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                                                </div>
                                                <h5 style="text-align: center; margin-top: -50px"> Ancune image de couverture pour le moment. </h5>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                            <div v-else>
                                                <div class="row g-3" >
                                                    <div class="col-sm-12 col-lg-12"  >
                                                        <div class="card bg-transparent" v-if="og_file_url.type_file_id == 1">
                                                            <!-- Card img -->
                                                            <img   class="card-img rounded" :src='getImage(og_file_url.file_url)' style="height: 400px; object-fit: cover;  cursor:pointer"  >

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chart END -->
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4"  >
                                <button type="button" @click="stepStorePublicitesThreeToTwoButton" class="btn btn-danger border-0 me-2"><i class="fa fa-angle-left"></i>Précédent</button>
                                <button type="submit"  @click="stepStorePublicitesThreeToFourButton" class="btn btn-primary">Suivant<i class="fa fa-angle-right"></i></button>
                            </div>
                        </div>
                        <div v-if="stepStorePublicitesFourState">
                            <div class="row" v-if="alreadyCreate == false">
                                <div class="col-lg-12 mb-3">
                                    <div class="row g-3 g-sm-4">
                                        <div class="col-sm-3">
                                            <div class="bg-light rounded-2 p-3">
                                                <div class="form-check form-check-inline mb-0">
                                                    <input class="form-check-input" type="checkbox" v-model="entete_site" name="entete_site" id="delivery1"  >
                                                    <label class="form-check-label h5 mb-0" for="delivery1">A l'entête du site</label>
                                                    <p class="mb-1 small">Afficher la publicité en l'entête du site</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delivery option -->
                                        <div class="col-sm-3">
                                            <div class="bg-light rounded-2 p-3">
                                                <div class="form-check form-check-inline mb-0">
                                                    <input class="form-check-input" type="checkbox"  v-model="entre_publications" name="entre_publications" id="delivery2">
                                                    <label class="form-check-label h5 mb-0" for="delivery2">Entre les publications </label>
                                                    <p class="mb-1 small">Afficher la publicité entre les publications sur la page d'accueil</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="bg-light rounded-2 p-3">
                                                <div class="form-check form-check-inline mb-0">
                                                    <input class="form-check-input" type="checkbox" v-model="toutes_les_pages" name="toutes_les_pages" id="delivery3"  >
                                                    <label class="form-check-label h5 mb-0" for="delivery3">Sur toutes les pages</label>
                                                    <p class="mb-1 small">Afficher la publicité entre les publications sur toutes les pages</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="bg-light rounded-2 p-3">
                                                <div class="form-check form-check-inline mb-0">
                                                    <input class="form-check-input" type="checkbox" v-model="dans_les_contenus" name="dans_les_contenus" id="delivery4">
                                                    <label class="form-check-label h5 mb-0" for="delivery4">Dans les contenus</label>
                                                    <p class="mb-1 small">Afficher la publicité à l'intérieur des contenus des publications</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label" >Statut de publication</label>
                                    <select class="form-select" @change="handleSelectionSearchByStatus($event)" v-model="status" name="status" id="status">
                                        <option value="1" >Publier à l'instant</option>
                                        <option value="0" >Enregistrer comme brouillon</option>
                                        <option value="2" >Programmer la publication</option>
                                        <option value="3" >Mettre en attente de validation</option>
                                    </select>
                                </div>
                                <div class="col-lg-4" v-if="show_date_publish">
                                    <div class="mb-3" >
                                        <label class="form-label">Choisir une de date de début</label>
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" v-model="date_publish" />
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4" v-if="show_date_publish_end">
                                    <div class="mb-3" >
                                        <label class="form-label">Choisir une de date de fin</label>
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" v-model="date_publish_end" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-4" v-if="loadingPublicationStorePublicitesCreate == false">
                                    <button type="button" @click="stepStorePublicitesFourToThreeButton" class="btn btn-danger border-0 me-2"><i class="fa fa-angle-left"></i>Précédent</button>
                                    <button type="submit"  @click="publicationStorePublicites" class="btn btn-primary">Enregistrer</button>
                                </div>
                                <div class="d-flex justify-content-end mt-4" v-else>
                                    <button type="button" disabled class="btn btn-success border-0 me-2">
                                        <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                        <span class="sr-only">Loading...</span>En cours de sauvegarde...</button>
                                </div>
                            </div>
                            <div class="row" v-else-if="alreadyCreate == true">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                    <div style="position: relative; height: 250px;">
                                        <img :src="`/assets/images/success.png`" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                                    </div>
                                    <h5 style="text-align: center; margin-top: -50px">
                                        Votre publication a été enregistré avec succès. <br>  <br>
                                        <span  @click="addPlusButton"  class="btn btn-success  border-0 me-2"><i class="fa fa-plus"></i>Ajouter une autre publication</span>
                                    </h5><br>

                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="authFormModalpublicationStorePublicitesCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">


            <!-- Login Form -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="authSectionStepModal == 1">Se connecter</h5>
                    <h5 class="modal-title" v-else-if="authSectionStepModal == 2">Modifier le mot de passe</h5>
                    <h5 class="modal-title" v-else-if="authSectionStepModal == 3">S'inscrire</h5>
                    <button type="button" class="btn-close" @click="authFormModalpublicationStorePublicitesCreateClose" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <label class="form-label" for="exampleInputPassword1">Mot de passe</label>
                                <input v-model="password" name="password" class="form-control fakepassword is-invalid" type="password" id="psw-input" placeholder="*********">
                                <div class="input-group">
                                    <input v-model="password" name="password" class="form-control fakepassword" type="password" id="psw-input" placeholder="*********">
                                    <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                        <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                        <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                    </span>
                                </div>
                                <div class="rounded mt-1" id="psw-strength"></div>
                                <div id="exampleInputPassword1" v-for="errorPassword in errorsLogin.password" :key="errorPassword" class="invalid-feedback">
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
                                        <input v-model="password" name="password" class="form-control fakepassword is-invalid" type="password" id="psw-input" placeholder="Veuillez entrer votre nouveau mot de passe">
                                        <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                            <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                    <div id="exampleInputpassword1" v-for="errorpassword in errorsForgotPasswordThree.password" :key="errorpassword" class="invalid-feedback">
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

                                <div class="mb-3" v-if="errorsForgotPasswordThree.password_confirm">
                                    <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                    <div class="input-group">
                                        <input type="password" v-model="password_confirm" class="form-control fakepassword is-invalid"  name="password_confirm"  id="psw-input_c" placeholder="Veuillez confirmer le mot de passe">
                                        <span class="input-group-text p-0" @click="showPasswordC" style="cursor: pointer">
                                            <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                    <div id="exampleInputpassword1" v-for="errorpassword_confirm in errorsForgotPasswordThree.password_confirm" :key="errorpassword_confirm" class="invalid-feedback">
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
import moment from 'moment'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import {Bootstrap5Pagination, TailwindPagination } from '../../../../../../libraries/pagination/lib';
export default {

    components: {
        QuillEditor, Bootstrap5Pagination, TailwindPagination,
    },

    props: {
        publicationCreate: null,
    },

    data () {
        return {
            meRoleName: null,
            publicationCreateBySlugTypeShowData: {},
            publicationCreateBySlugTypeShowMessage: null,
            meProfileUserName: null,
            meProfileRoleName: null,
            authSectionModal: 'CREATEPUBLICITES',
            publicationStorePublicitesCreateData: {},
            publicationStorePublicitesCreateMessage: null,
            publicationStorePublicitesCreateErrors: { },
            manageFilesPubStoreCreateData: {},
            manageFilesPubStoreCreateMessage: null,
            manageFilesPubStoreCreateErrors: { },
            username: null,
            email:null,
            password: null,
            password_confirm: null,
            loadingLogin: false,
            errorLogin: false,
            errorsLogin: [],
            loadingConnect: false,
            remember_me: false,
            authSectionStepModal: 1,
            loadingForgotPasswordFirst: false,
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
            status: 1,
            title: null,
            link_publicites: null,
            entete_site: false,
            dans_les_contenus: false,
            entre_publications: true,
            toutes_les_pages: true,
            date_publish: null,
            date_publish_end: null,
            show_date_publish: false,
            show_date_publish_end: true,
            showPsw: false,
            showPswC: false,
            loadingPublicationStorePublicitesCreate: false,
            alreadyCreate: false,
            config: {
                events: {
                    initialized: function () {
                    console.log('initialized')
                    }
                }
            },
            stepStorePublicitesFirstState: true,
            stepStorePublicitesTwoState: false,
            stepStorePublicitesThreeState: false,
            stepStorePublicitesFourState: false,
            UploadStateButton: true,
            LinkStateButton: false,
            IframeStateButton: false,
            ExistStateButton: false,
            file_name: null,
            file_url: null,
            description_file: null,
            active: false,
            dropzoneFile: [ ],
            files_selected: [ ],
            filesMessage: null,
            filesData: { },
            emptyFiles: 0,
            statusFiles: 3,
            loadingFiles: true,
            style: 'bootstrap5',
            limit: 1,
            keepLength: false,
            showDisabled: false,
            size: 'default',
            align: 'left',
            search: '',
            og_file_url: null,
            images_og:[],
        }
    },
    computed: {
        ...mapGetters("roleSecurity",{
            gettersMeRoleName:"getMeRoleName",
            gettersRoleStatus:'getRoleStatus',
        }),

        ...mapGetters('publicationAdmin',{
            getterInfosPublicationCreateBySlugTypeShowStatus:'getInfosPublicationCreateBySlugTypeShowStatus',
            getterInfosPublicationCreateBySlugTypeShowMessage:'getInfosPublicationCreateBySlugTypeShowMessage',
            getterInfosPublicationCreateBySlugTypeShowData:'getInfosPublicationCreateBySlugTypeShowData',
        }),

        ...mapGetters('publicitesAdmin',{
            getterInfosPublicationStorePublicitesStatus:'getInfosPublicationStorePublicitesStatus',
            getterInfosPublicationStorePublicitesMessage:'getInfosPublicationStorePublicitesMessage',
            getterInfosPublicationStorePublicitesData:'getInfosPublicationStorePublicitesData',
            getterInfosPublicationStorePublicitesErrors:'getInfosPublicationStorePublicitesErrors',
            getterInfosPublicationGetFilesStatus:'getInfosPublicationGetFilesStatus',
            getterInfosPublicationGetFilesMessage:'getInfosPublicationGetFilesMessage',
            getterInfosPublicationGetFilesData:'getInfosPublicationGetFilesData',
            getterInfosPublicationSearchByTypeFilesStatus:'getInfosPublicationSearchByTypeFilesStatus',
            getterInfosPublicationSearchByTypeFilesMessage:'getInfosPublicationSearchByTypeFilesMessage',
            getterInfosPublicationSearchByTypeFilesData:'getInfosPublicationSearchByTypeFilesData',
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


        ...mapActions("publicationAdmin",{
          actionsPublicationCreateBySlugTypeShowDataRequest:'publicationCreateBySlugTypeShowDataRequest',
        }),

        ...mapActions("publicitesAdmin",{
          actionsPublicationStorePublicitesDataRequest:'publicationStorePublicitesDataRequest',
          actionsPublicationGetFilesDataRequest:'publicationGetFilesDataRequest',
          actionsPublicationSearchByTypeFilesDataRequest:'publicationSearchByTypeFilesDataRequest',
        }),

        addPlusButton(){
            this.cancelFirst()
            this.stepStorePublicitesTwoToFirstButton()
            this.alreadyCreate = false
        },

        stepStorePublicitesFirstToTwoButton(){
            this.stepStorePublicitesFirstState= false
            this.stepStorePublicitesTwoState= true
            this.stepStorePublicitesThreeState= false
        },

        stepStorePublicitesTwoToThreeButton(){
            this.stepStorePublicitesFirstState= false
            this.stepStorePublicitesTwoState= false
            this.stepStorePublicitesThreeState= true
        },

        stepStorePublicitesThreeToFourButton(){
            this.stepStorePublicitesFirstState= false
            this.stepStorePublicitesTwoState= false
            this.stepStorePublicitesThreeState= false
            this.stepStorePublicitesFourState= true
        },

        stepStorePublicitesFourToThreeButton(){
            this.stepStorePublicitesFirstState= false
            this.stepStorePublicitesTwoState= false
            this.stepStorePublicitesThreeState= true
            this.stepStorePublicitesFourState= false

        },

        stepStorePublicitesThreeToTwoButton(){
            this.stepStorePublicitesFirstState= false
            this.stepStorePublicitesTwoState= true
            this.stepStorePublicitesThreeState= false
            this.stepStorePublicitesFourState= false
        },

        stepStorePublicitesTwoToFirstButton(){
            this.stepStorePublicitesFirstState= true
            this.stepStorePublicitesTwoState= false
            this.stepStorePublicitesThreeState= false
            this.stepStorePublicitesFourState= false
        },


        UploadState(){

            this.UploadStateButton = true,
            this.LinkStateButton = false,
            this.IframeStateButton = false,
            this.ExistStateButton = false

        },

        LinkState(){

            this.UploadStateButton = false,
            this.LinkStateButton = true,
            this.IframeStateButton = false,
            this.ExistStateButton = false

        },

        IframeState(){

            this.UploadStateButton = false,
            this.LinkStateButton = false,
            this.IframeStateButton = true,
            this.ExistStateButton = false

        },

        ExistState(){

            this.UploadStateButton = false,
            this.LinkStateButton = false,
            this.IframeStateButton = false,
            this.ExistStateButton = true
            this.getFiles()

        },

        getImage(slug){
            return slug;
        },

        selectFiles(file_name, type_file_id, file_url){

            if(this.files_selected.length == 0){

                if(type_file_id == 1){

                    this.images_og.push({file_name: file_name, type_file_id: type_file_id, file_url: file_url})

                    this.files_selected.push({file_name: file_name, type_file_id: type_file_id, file_url: file_url})

                }else{

                    this.files_selected.push({file_name: file_name, type_file_id: type_file_id, file_url: file_url})

                }

            }else{

                const info = file_name

                const result = this.files_selected.find(({ file_name }) => file_name === info);

                if(result){

                    console.log(result);

                }else{

                    if(type_file_id == 1){

                        this.images_og.push({file_name: file_name, type_file_id: type_file_id, file_url: file_url})

                        this.files_selected.push({file_name: file_name, type_file_id: type_file_id, file_url: file_url})

                    }else{

                        this.files_selected.push({file_name: file_name, type_file_id: type_file_id, file_url: file_url})

                    }

                }


            }



        },



        selectFilesOg(file_name, type_file_id, file_url){

            if(type_file_id == 1){

                this.og_file_url= {file_name: file_name, type_file_id: type_file_id, file_url: file_url}

            }
        },

        async handleSelectionSearchByStatus(event ){

            this.status = event.target.value

            if(this.status == 2){

                this.show_date_publish = true

                this.show_date_publish_end = true

                const date = new Date()

                this.date_publish = date.toISOString().slice(0, 16)
            }else{

                this.show_date_publish = false

                if(this.status == 0 || this.status ==3 ){

                    this.show_date_publish_end = false

                }else{

                    this.show_date_publish_end = true

                }

            }


        },

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

        authFormModalpublicationStorePublicitesCreateClose(){
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            $('#authFormModalpublicationStorePublicitesCreate').modal('hide');
        },


        authModalClick(action_auth="LIST", name=null, slug=null){

            if(localStorage.getItem('remember_me') == "true" && localStorage.getItem('username') && localStorage.getItem('password')){

                this.username = localStorage.getItem('username')

                this.password = localStorage.getItem('password')

                this.remember_me = localStorage.getItem('remember_me')
            }

            this.name = name

            this.slug = slug

            this.authSectionModal= action_auth

            if(this.authSectionModal == "CREATEPUBLICITES"){

                this.loadingPublicationStorePublicitesCreate = false

            }
            $('#authFormModalpublicationStorePublicitesCreate').modal('show');


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
        },

        changeAuthSectionStepModalToForgotPassword(){
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.authSectionStepModal = 2
        },

        changeAuthSectionStepModalToLogin(){
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.authSectionStepModal = 1
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

                this.errorLogin = false
                this.errorsLogin = []

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



                    if(this.authSectionModal== 'CREATEPUBLICITES'){

                        this.authFormModalpublicationStorePublicitesCreateClose()

                        this.loadingPublicationStorePublicitesCreate = true

                        this.publicationStorePublicitesCreate()

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

                    if(this.authSectionModal== 'CREATEPUBLICITES'){

                        this.authFormModalpublicationStorePublicitesCreateClose()

                        this.loadingPublicationStorePublicitesCreate = true

                        this.publicationStorePublicitesCreate()

                    }
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


        cancelFirst(){
            this.title = null
            this.status = 1
            link_publicites: null
            this.entete_site = false
            this.dans_les_contenus = false
            this.entre_publications = true
            this.toutes_les_pages = true
            this.date_publish = null
            this.show_date_publish = false
            this.show_date_publish_end = true
            this.alreadyCreate = false;
        },

        async publicationStorePublicites(){

            this.loadingPublicationStorePublicitesCreate = true

            this.authSectionModal= 'CREATEPUBLICITES'

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeRole();

                if(this.gettersRoleStatus === 'success'){

                    this.meRoleName = this.gettersMeRoleName

                    if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbtsd!?')){

                        this.publicationStorePublicitesCreate()

                    }else{

                        this.authModalClick('CREATEPUBLICITES')

                    }

                }else if(this.gettersRoleStatus === 'failed'){

                    this.authModalClick('CREATEPUBLICITES')
                }

            }else{

                this.authModalClick('CREATEPUBLICITES')

            }

        },

        async publicationStorePublicitesCreate(){

            this.loadingPublicationStorePublicitesCreate = true

            this.authSectionModal= 'CREATEPUBLICITES'

            this.publicationStorePublicitesCreateMessage =  null
            this.publicationStorePublicitesCreateErrors = []

            if(this.status == 1){
                const date = new Date()

                this.date_publish = date.toISOString().slice(0, 16)
            }

            await this.actionsPublicationStorePublicitesDataRequest({ slug : this.$route.params.slug, title : this.title, link_publicites: this.link_publicites , entre_publications: this.entre_publications,entete_site: this.entete_site ,dans_les_contenus :  this.dans_les_contenus , toutes_les_pages :  this.toutes_les_pages ,status : this.status, date_publish : this.date_publish,  date_publish_end : this.date_publish_end,  og_file_url : this.og_file_url.file_url  ,files_selected : this.files_selected  });

            if( this.getterInfosPublicationStorePublicitesStatus ==="success"){

                this.publicationStorePublicitesCreateData = this.getterInfosPublicationStorePublicitesData

                this.publicationStorePublicitesCreateMessage =  null
                this.publicationStorePublicitesCreateErrors = []


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
                    title: this.getterInfosPublicationStorePublicitesMessage
                })

                this.loadingPublicationStorePublicitesCreate = false

                this.publicationStorePublicitesCreateMessage =  null
                this.publicationStorePublicitesCreateErrors = []

                this.publicationStorePublicitesCreateData = this.getterInfosPublicationStorePublicitesData

                this.alreadyCreate = true;

            }else if( this.getterInfosPublicationStorePublicitesStatus ==="empty"){

                this.publicationStorePublicitesCreateMessage = this.getterInfosPublicationStorePublicitesMessage

                this.publicationStorePublicitesCreateErrors = this.getterInfosPublicationStorePublicitesErrors

                this.loadingPublicationStorePublicitesCreate = false


            }else if( this.getterInfosPublicationStorePublicitesStatus ==="error"){

                this.publicationStorePublicitesCreateMessage = this.getterInfosPublicationStorePublicitesMessage

                this.publicationStorePublicitesCreateErrors = []

                this.loadingPublicationStorePublicitesCreate = false

            }
        },

        async getFiles( page=1){

            await this.actionsPublicationGetFilesDataRequest({slug : this.$route.params.slug, page : page, search: this.search });

            if( this.getterInfosPublicationGetFilesStatus ==="success"){

                this.filesData = this.getterInfosPublicationGetFilesData

                this.empty = 0

                this.loadingFiles = false

            }else if( this.getterInfosPublicationGetFilesStatus ==="empty"){

                this.filesMessage = this.getterInfosPublicationGetFilesMessage

                this.empty = 1

                this.loadingFiles = false

            } else{

                this.filesMessage = this.getterInfosPublicationGetFilesMessage

                this.empty = 3

                this.loadingFiles = false

            }
        },

        async handleSelectionSearchByStatusFiles(event, page=1){

            this.status = event.target.value

            await this.actionsPublicationSearchByTypeFilesDataRequest({ slug : this.$route.params.slug, page : page, status: this.status, search: this.search});

            if( this.getterInfosPublicationSearchByTypeFilesStatus ==="success"){

                this.filesData = this.getterInfosPublicationSearchByTypeFilesData

                this.empty = 0

            }else if( this.getterInfosPublicationSearchByTypeFilesStatus ==="empty"){

                this.filesMessage = this.getterInfosPublicationSearchByTypeFilesMessage

                this.empty = 1

            } else{

                this.filesMessage = this.getterInfosPublicationSearchByTypeFilesMessage

                this.empty = 3

            }
        },

        removeFiles(index) {
            this.files_selected.splice(index, 1);
        }

    },
    mounted() {

        this.moment = moment
    },
};
</script>
