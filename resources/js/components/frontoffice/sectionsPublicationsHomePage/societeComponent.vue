<script setup>
import { ref, onMounted } from 'vue';
import moment from 'moment';
import { useStore } from 'vuex';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
const store = useStore();
const loading = ref(true);
const societeLoadButtonStatus = ref(false);
const societeData = ref({});
const societeMessage = ref(null);
const empty = ref(2);

const getResults = async () => {
  loading.value = true;
  await store.dispatch('sectionsPublicationsHomePage/societeDataRequest', {});

  const status = store.getters['sectionsPublicationsHomePage/getInfosSocieteStatus'];
  const message = store.getters['sectionsPublicationsHomePage/getInfosSocieteMessage'];
  const data = store.getters['sectionsPublicationsHomePage/getInfosSocieteData'];

  if (status === 'success') {
    societeData.value = data;
    empty.value = 0;
  } else {
    societeMessage.value = message;
    empty.value = status === 'empty' ? 1 : 3;
  }
  loading.value = false;
};

const author = (slug) => {
  window.location = `/authors/${slug}`;
};

const article = (slug) => {
  window.location = `/${slug}`;
};

const societeLoadButton = (slug) => {
    societeLoadButtonStatus.value = true;
};

const getImage = (slug) => slug;

onMounted(() => {
  getResults();
});
</script>
<template>
    <div v-if="loading">
    </div>
    <div v-else class="container mb-4">
        <div class="row">
            <!-- Title -->
            <div class="col-lg-9">


                <div class="col-md-12 ">
                    <div class="d-flex mb-2">
                         
                        <div>
                            <h2 class="text-success m-0 alaune_title">COMMUNIQUE</h2> 
                        </div>
                    </div>
                    <!-- Title -->

                </div>

                <div class="row">

                    <div class="col-sm-6 col-lg-6" v-for="result in societeData.societe" :key="result.id">
                        <div class="card">
                            <!-- Card img -->
                            <div class="position-relative">
                                <img class="card-img" :src='getImage(result.image_cover_url)' style="height: 260px; width: 550px ; object-fit: cover" alt="Card image">

                            </div>
                            <div class="card-body px-0 pt-3">
                                <h6 class="card-title"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-bold" v-html="result.title"></span></h6>
                                <div>
                                    <div v-html="result.truncate_content">  </div>
                                </div>
                                <ul class="nav nav-divider align-items-center  d-sm-inline-block" style="font-size: 12px">
                                    <li class="nav-item">
                                        <div class="nav-link">
                                            <div class="d-flex align-items-center position-relative">
                                                <div class="avatar avatar-xs">
                                                    <div class="avatar-img rounded-circle bg-success">
                                                        <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ result.author_name[0].toUpperCase()  }}{{ result.author_name[1].toUpperCase()  }}</span>
                                                    </div>
                                                </div>
                                                <span class="ms-3">par <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-5" v-if="!societeLoadButtonStatus">
                        <button type="button" @click="societeLoadButton" class="btn btn-success-soft">Voir plus<i class="bi bi-arrow-down-circle ms-2 align-middle"></i></button>
                    </div>
                    <div class="col-sm-6 col-lg-6" v-else-if="societeLoadButtonStatus" v-for="result in societeData.societeLoad" :key="result.id">
                        <div class="card">
                            <!-- Card img -->
                            <div class="position-relative">
                                <img class="card-img" :src='getImage(result.image_cover_url)' style="height: 260px; width: 550px ; object-fit: cover" alt="Card image">

                            </div>
                            <div class="card-body px-0 pt-3">
                                <h6 class="card-title"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-bold" v-html="result.title"></span></h6>
                                <div>
                                    <div v-html="result.truncate_content">  </div>
                                </div>
                                <ul class="nav nav-divider align-items-center  d-sm-inline-block" style="font-size: 12px">
                                    <li class="nav-item">
                                        <div class="nav-link">
                                            <div class="d-flex align-items-center position-relative">
                                                <div class="avatar avatar-xs">
                                                    <div class="avatar-img rounded-circle bg-success">
                                                        <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ result.author_name[0].toUpperCase()  }}{{ result.author_name[1].toUpperCase()  }}</span>
                                                    </div>
                                                </div>
                                                <span class="ms-3">par <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row g-2">
                    <!-- Facebook -->
                    <div class="col-4">
                        <a href="https://www.facebook.com/Togoactualite-148480121847124" target="_blank" class="bg-facebook rounded text-center text-white-force p-3 d-block">
                        <i class="fab fa-facebook-square fs-5 mb-2"></i>
                        <h6 class="m-0">1.5K</h6>
                        <span class="small">Abonnés</span>
                        </a>
                    </div>
                    <!-- Twitter -->
                    <div class="col-4">
                        <a href="https://x.com/Togoactualite" target="_blank" class="bg-dark rounded text-center text-white-force p-3 d-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x fs-5 mb-2" viewBox="0 0 16 16">
                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                        </svg>
                        <h6 class="m-0">5K</h6>
                        <span class="small">abonnés</span>
                        </a>
                    </div>

                    <!-- Whatsapp -->
                    <div class="col-4">
                        <a href="https://fr.linkedin.com/in/togoactualite-togo-actualit%C3%A9-3a076648" target="_blank" class="bg-linkedin rounded text-center text-white-force p-3 d-block">
                        <i class="fab fa-linkedin fs-5 mb-2"></i>
                        <h6 class="m-0">1.8K</h6>
                        <span class="small">Abonnés</span>
                        </a>
                    </div>

                </div>
                <!-- Trending topics widget START -->
                <div>
                    <h4 class="mt-4 mb-3">Mot clés populaires:</h4>
                    <div v-for="info in societeData.tags" :key="info.id">
                        <!-- Category item -->
                        <div class="mt-1 d-flex justify-content-between align-items-center bg-primary bg-opacity-15 rounded p-2 position-relative" >

                            <h6 class="m-0 text-primary">#{{ info.name }} </h6>
                            <span  @click="tag(info.slug)" style="cursor: pointer"  class="badge bg-primary text-light stretched-link">{{ info.count_publications }}</span>

                        </div>

                    </div>
                    <div class="text-center mt-3">
                        <a href="/search-posts" class="fw-bold text-body text-primary-hover"><u>Rechercher un article</u></a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-12 mt-3">
                    <div class="d-flex mb-2">

                        <div>
                            <h6 class="text-success m-0 alaune_title">Les plus récents</h6>
                        </div>
                    </div>
                    <div class="card mb-3"  v-for="result in societeData.populars" :key="result.id">
                        <div class="row g-3">
                            <div class="col-4">
                                <img class="rounded" :src='getImage(result.image_cover_url)' style="height: 80px; width: 550px ; object-fit: cover" :alt='result.title'>
                            </div>
                            <div class="col-8">
                                <h6><span @click="article(result.slug)" style="cursor: pointer" class="btn-link stretched-link text-reset fw-bold" v-html="result.title_truncate"></span></h6>
                                <ul class="nav nav-divider align-items-center text-uppercase d-sm-inline-block" style="font-size: 10px">
                                    <li class="nav-item">
                                        <div class="nav-link">
                                            <div class="d-flex align-items-center position-relative">

                                                <span class="ms-3">  <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
