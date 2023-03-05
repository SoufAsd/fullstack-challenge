<script lang="ts" setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { watch } from "vue";
import { useModalStore } from "../stores/modal";
import { useWeatherStore } from "../stores/weather";

interface user {
  user: {};
}

const props = defineProps({
  user: {},
});

const modalStore = useModalStore();
const weatherStore = useWeatherStore();

const url = `${import.meta.env.VITE_API_URL}weather/${modalStore.user_id}`;

const detailsWeather = ref();
const modelstatus = ref();

detailsWeather.value = weatherStore.getWeather;

const closeModal = (e: Event) => {
  modalStore.toggleModal();
};
</script>

<template>
  <v-dialog v-model="modalStore.getModalStatus" width="auto">
    <v-card>
      <v-card-text v-if="weatherStore.getWeather != null">
        <p class="font-weight-bold">Weather : {{weatherStore.getWeather.weather}}</p>
        <p class="font-weight-bold">Temperature : {{weatherStore.getWeather.temperature}}</p>
        <p class="font-weight-bold">Humidity : {{weatherStore.getWeather.humidity}}</p>
        <p class="font-weight-bold">Wind : {{weatherStore.getWeather.wind}}</p>
      </v-card-text>
      <v-card-text v-else>
        <p class="font-weight-bold">Not yet available</p>
      </v-card-text>
      <v-card-actions>
        <v-btn color="primary" block @click="closeModal">Close Dialog</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
