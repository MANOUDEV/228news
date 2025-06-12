<script setup>
import { ref, onMounted } from 'vue';
import moment from 'moment';
import { useStore } from 'vuex';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
const store = useStore();
const loading = ref(true);
const importantData = ref({});
const optionsOneimportant = ref({ type : 'loop',
    autoplay: true,
    interval: 3000,
    breakpoints: {
        640: {
            perPage: 1,
            pagination:false
        },

    },});
const importantMessage = ref(null);
const empty = ref(2);

const getResults = async () => {
  loading.value = true;
  await store.dispatch('sectionsPublicationsHomePage/importantDataRequest', {});

  const status = store.getters['sectionsPublicationsHomePage/getInfosImportantStatus'];
  const message = store.getters['sectionsPublicationsHomePage/getInfosImportantMessage'];
  const data = store.getters['sectionsPublicationsHomePage/getInfosImportantData'];

  if (status === 'success') {
    importantData.value = data;
    empty.value = 0;
  } else {
    importantMessage.value = message;
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
        <div class="row mb-4">
            <!-- Entertainment START -->
            <div class="col-md-12 ">
                <div class="d-flex mb-2">
                    
                    <div>
                        <h2 class="text-success m-0 alaune_title">Conseil des ministres</h2> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Title -->
                        <Splide :options="optionsOneImportant" aria-label="My Favorite Images">

                            <SplideSlide v-for="result in importantData.importantFirst" :key="result.id">
                                <div>
                                    <div class="card card-overlay-bottom card-img-scale">
                                        <!-- Card Image -->
                                        <img class="card-img important_first_section_img_responsive" :src='getImage(result.image_cover_url)' :alt='result.title'>
                                        <!-- Card Image overlay -->
                                        <div class="card-img-overlay rounded-0 d-flex align-items-center">
                                            <div class="container px-3 my-auto">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <!-- Card title -->
                                                        <h2 class="text-white display-5"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-normal" v-html="result.title_truncate"></span></h2>
                                                        <div class="text-white-force">
                                                            <div v-html="result.truncate_content">  </div>
                                                        </div>
                                                        <!-- Card info -->
                                                        <ul class="nav nav-divider align-items-center text-white-force d-none d-sm-inline-block" style="font-size: 12px">
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
                                                            <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-comment-alt me-1"></i> {{ result.comment_count }}</a></li>
                                                            <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-thumbs-up me-1"></i> {{ result.likes_count }}</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </SplideSlide>
                        </Splide>

                    </div>

                </div>
            </div>
        </div>
    </div>

</template>
