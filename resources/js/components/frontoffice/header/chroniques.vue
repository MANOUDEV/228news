<script setup>
import { ref, onMounted } from 'vue';
import moment from 'moment';
import { useStore } from 'vuex';

const store = useStore();
const loading = ref(true);
const chroniquesData = ref({});
const chroniquesMessage = ref(null);
const chroniquesState = ref(true);
const communiqueState = ref(false);
const economieState = ref(false);
const empty = ref(2);

const getResults = async () => { 
  await store.dispatch('chroniques/chroniquesDataRequest', {});

  const status = store.getters['chroniques/getInfosChroniquesStatus'];
  const message = store.getters['chroniques/getInfosChroniquesMessage'];
  const data = store.getters['chroniques/getInfosChroniquesData'];

  if (status === 'success') {
    chroniquesData.value = data;
    empty.value = 0;
  } else {
    chroniquesMessage.value = message;
    empty.value = status === 'empty' ? 1 : 3;
  }
  loading.value = false;
};

const chroniquesH = () => {
  economieState.value= false
  communiqueState.value= false
  chroniquesState.value= true
  getResults();
}
const economie = async () => {
  economieState.value= true
  communiqueState.value= false
  chroniquesState.value= false 
  await store.dispatch('chroniques/economieDataRequest', {});

  const status = store.getters['chroniques/getInfosEconomieStatus'];
  const message = store.getters['chroniques/getInfosEconomieMessage'];
  const data = store.getters['chroniques/getInfosEconomieData'];

  if (status === 'success') {
    chroniquesData.value = data;
    empty.value = 0;
  } else {
    chroniquesMessage.value = message;
    empty.value = status === 'empty' ? 1 : 3;
  } 
};

const communique = async () => {
  economieState.value= false
  communiqueState.value= true
  chroniquesState.value= false 
  await store.dispatch('chroniques/communiqueDataRequest', {});

  const status = store.getters['chroniques/getInfosCommuniqueStatus'];
  const message = store.getters['chroniques/getInfosCommuniqueMessage'];
  const data = store.getters['chroniques/getInfosCommuniqueData'];

  if (status === 'success') {
    chroniquesData.value = data;
    empty.value = 0;
  } else {
    chroniquesMessage.value = message;
    empty.value = status === 'empty' ? 1 : 3;
  } 
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
    <div class="container">

        <div v-if="loading">
            <br><br><br>
            <div class="d-flex justify-content-center mt-3">
                <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <br><br><br>
        </div>
        <div v-else class="row g-4 p-3 flex-fill">

            <div  v-if="empty === 1">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div style="position: relative; height: 250px;">
                          <img :src="`/assets/images/empty.png`" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                      </div>
                      <h5 style="text-align: center; margin-top: -50px"> {{ chroniquesMessage  }} </h5>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <div  v-if="empty === 3">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div style="position: relative; height: 250px;">
                          <img :src="`/assets/images/error.png`" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                      </div>
                      <h5 style="text-align: center; margin-top: -50px"> {{ chroniquesMessage  }} </h5>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- Card item START -->
            <div class="col-sm-6 col-lg-3" v-else-if="empty === 0" v-for="result in chroniquesData" :key="result.id">
                <div class="card bg-transparent" v-if="result.image_cover_url">
                    <!-- Card img -->
                    <img class="card-img rounded" :src='getImage(result.image_cover_url)' style="height: 150px; object-fit: cover" :alt='result.title'>
                    <div class="card-body px-0 pt-3">
                        <h6 class="card-title mb-0"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-bold" v-html="result.title"></span></h6>
                        <!-- Card info -->
                        <ul class="nav nav-divider align-items-center text-uppercase small mt-2"> 
                            <li class="nav-item">
                                <span @click="author(result.author_slug)" style="cursor: pointer" class="text-reset btn-link">{{ result.author_name }}</span>
                            </li>
                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                        </ul>
                    </div>
                </div>
                <div v-else>
                    <div class="card mb-4">
                        <div class="card-body border rounded-3">
                            
                            <h6 class="card-title mb-0"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-bold" v-html="result.title"></span></h6>
                            <p class="card-text" v-html="result.truncate_content"> </p>
                            <!-- Card info -->
                            <ul class="nav nav-divider align-items-center text-uppercase small mt-2">
                                <li class="nav-item">
                                    <span @click="author(result.author_slug)" style="cursor: pointer" class="text-reset btn-link">{{ result.author_name }}</span>
                                </li>
                                <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row px-3">
                <div class="col-12">
                    <ul class="list-inline mt-3">
                        <li class="list-inline-item">
                            <span style="cursor: pointer" v-if="chroniquesState" @click="chroniquesH" class="btn btn-sm btn-success">Chroniques</span>
                            <span style="cursor: pointer" v-else @click="chroniquesH" class="btn btn-sm btn-primary-soft"><Cc:ie></Cc:ie>hroniques</span>
                        </li>
                        
                        <li class="list-inline-item">
                            <span style="cursor: pointer" v-if="economieState" @click="economie" class="btn btn-sm btn-success">Economie</span>
                            <span style="cursor: pointer" v-else @click="economie" class="btn btn-sm btn-primary-soft">Economie</span>
                        </li>
                        <li class="list-inline-item">
                            <span style="cursor: pointer" v-if="communiqueState" @click="communique" class="btn btn-sm btn-success">Communiqué </span>
                            <span style="cursor: pointer" v-else @click="communique" class="btn btn-sm btn-primary-soft">Communiqué </span>
                        </li>
                        
                    </ul>
                </div>
            </div> <!-- Row END -->
        </div>
    </div>
</template>
