<script setup>
import { ref, onMounted } from 'vue';
import moment from 'moment';
import { useStore } from 'vuex';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
const store = useStore();
const loading = ref(true);
const opinionFaitsDiversData = ref({});
const optionsOneOpinionFaitsDivers = ref({ type : 'loop',
        autoplay: true,
        interval: 3000,
        breakpoints: {
            640: {
                perPage: 1,
                pagination:false
            },

        }});
const opinionFaitsDiversMessage = ref(null);
const empty = ref(2);

const getResults = async () => {
  loading.value = true;
  await store.dispatch('sectionsPublicationsHomePage/opinionFaitsDiversDataRequest', {});

  const status = store.getters['sectionsPublicationsHomePage/getInfosOpinionFaitsDiversStatus'];
  const message = store.getters['sectionsPublicationsHomePage/getInfosOpinionFaitsDiversMessage'];
  const data = store.getters['sectionsPublicationsHomePage/getInfosOpinionFaitsDiversData'];

  if (status === 'success') {
    opinionFaitsDiversData.value = data;
    empty.value = 0;
  } else {
    opinionFaitsDiversMessage.value = message;
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

const getImage = (slug) => slug;

onMounted(() => {
  getResults();
});
</script>
<template>
    <div v-if="loading">
    </div>
    <div v-else class="container">
        <div class="row g-4 mb-4" >

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 ">
                    <div class="d-flex mb-2">
                        
                        <div>
                            <h2 class="text-success m-0 alaune_title">OPINION</h2> 
                        </div>
                    </div>
                    <!-- Title -->
                </div>

                <Splide :options="optionsOneOpinionFaitsDivers" aria-label="My Favorite Images">

                    <SplideSlide v-for=" result in opinionFaitsDiversData.opinion" :key="result.id">
                        <div>
                            <div class="card card-overlay-bottom card-img-scale">
                                <!-- Card Image -->
                                <img class="card-img opinion_faits_divers_first_section_img_responsive" :src='getImage(result.image_cover_url)' alt="" >
                                <!-- Card Image overlay -->
                                <div class="card-img-overlay d-flex flex-column p-3 p-sm-4">
                                    <div class="w-100 mt-auto">

                                        <!-- Card title -->
                                        <h4 class="text-white"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset stretched-link" v-html="result.title_truncate"></span></h4>
                                        <div class="text-white-force">
                                            <div v-html="result.truncate_content">  </div>
                                        </div>
                                        <!-- Card info -->
                                        <ul class="nav nav-divider align-items-center text-white-force text-uppercase d-sm-inline-block" style="font-size: 12px">
                                            <li class="nav-item">
                                                <div class="nav-link">
                                                    <div class="d-flex align-items-center position-relative">

                                                        <span class="ms-3"> <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </SplideSlide>
                </Splide>

            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 ">
                    <div class="d-flex mb-2">
                         
                        <div>
                            <h2 class="text-success m-0 alaune_title">FAITS DIVERS</h2> 
                        </div>
                    </div>
                    <!-- Title -->
                </div>

                <Splide :options="optionsOneOpinionFaitsDivers" aria-label="My Favorite Images">

                    <SplideSlide v-for=" result in opinionFaitsDiversData.faitsDivers" :key="result.id">
                        <div>
                            <div class="card card-overlay-bottom card-img-scale">
                                <!-- Card Image -->
                                <img class="card-img opinion_faits_divers_first_section_img_responsive" :src='getImage(result.image_cover_url)' alt="">
                                <!-- Card Image overlay -->
                                <div class="card-img-overlay d-flex flex-column p-3 p-sm-4">
                                    <div class="w-100 mt-auto">

                                        <!-- Card title -->
                                        <h4 class="text-white"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset stretched-link" v-html="result.title_truncate"></span></h4>
                                        <div class="text-white-force">
                                            <div v-html="result.truncate_content">  </div>
                                        </div>
                                        <!-- Card info -->
                                        <ul class="nav nav-divider align-items-center text-white-force text-uppercase d-sm-inline-block" style="font-size: 12px">
                                            <li class="nav-item">
                                                <div class="nav-link">
                                                    <div class="d-flex align-items-center position-relative">

                                                        <span class="ms-3"> <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </SplideSlide>
                </Splide>
            </div>
            <br>
        </div>
    </div>

</template>
