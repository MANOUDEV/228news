<script setup>
import { ref, onMounted } from 'vue';
import moment from 'moment';
import { useStore } from 'vuex';

const store = useStore();
const loading = ref(true);
const categoryPopularsData = ref({});
const categoryPopularsMessage = ref(null);
const empty = ref(2);

const getResults = async () => {
  loading.value = true;
  await store.dispatch('categoryPopulars/categoryPopularsDataRequest', {});

  const status = store.getters['categoryPopulars/getInfosCategoryPopularsStatus'];
  const message = store.getters['categoryPopulars/getInfosCategoryPopularsMessage'];
  const data = store.getters['categoryPopulars/getInfosCategoryPopularsData'];

  if (status === 'success') {
    categoryPopularsData.value = data;
    empty.value = 0;
  } else {
    categoryPopularsMessage.value = message;
    empty.value = status === 'empty' ? 1 : 3;
  }
  loading.value = false;
};

const category = (slug) => {
  window.location = `/${slug}`;
};

onMounted(() => {
  getResults();
});
</script>
<template> 
  <li v-for="info in categoryPopularsData.FirstSectionCategory" :key="info.id"> <span class="dropdown-item" style="cursor: pointer" @click="category(info.slug)">{{ info.name }}</span></li>
</template>
 