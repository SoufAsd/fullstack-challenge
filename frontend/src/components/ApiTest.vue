<script lang="ts" setup>
import { ref } from "vue";
import Modal from "./Modal.vue";
import { useModalStore } from "../stores/modal";
import { useWeatherStore } from "../stores/weather";
import * as mqtt from "mqtt";

let client = mqtt.connect("ws://test.mosquitto.org:8080");

interface weather {
  user_id: number;
  temperature: string;
  weather: any;
  humidity: any;
  wind: any;
}

interface user {
  id: number;
  name: string;
}

interface api {
  users: user[];
  weather: weather[];
}

const modalStore = useModalStore();
const weatherStore = useWeatherStore();

const url = `${import.meta.env.VITE_API_URL}weather`;
const apiResponse = ref<api>();

const fetchApi = async (url: string) => {
  apiResponse.value = await (await fetch(url)).json();
  weatherStore.setWeathers(apiResponse.value?.weather);
};

const toggleModal = (id: number, index: number) => {
  modalStore.toggleModal();
  modalStore.setUserId(id);
  weatherStore.setWeatherSelected(index);
};
client.subscribe("websocket/apiweatherget");

client.on("message", function (topic, message) {
  let id = JSON.parse(message.toString()).user_id,
    index = apiResponse.value?.weather?.findIndex(({ user_id: n }) => n === id);

  if (index) {
    if (apiResponse.value)
      apiResponse.value.weather[index] = JSON.parse(message.toString());
    weatherStore.setWeathers(apiResponse.value?.weather);
  }
});

fetchApi(url);
</script>

<template>
  <v-container class="bg-surface-variant">
    <v-row no-gutters>
      <v-col
        v-for="(user, index) in apiResponse?.users"
        :key="index"
        cols="12"
        sm="3"
      >
        <v-card class="ma-2" width="200">
          <template v-slot:title> {{ user.name }} </template>

          <template v-slot:subtitle>
            <p class="font-weight-black">Weather :</p>
            <p v-if="apiResponse?.weather[index]">
              {{ apiResponse?.weather[index].weather }}
            </p>
            <p v-else>Not yet available</p>
          </template>
          <template v-slot:text>
            <v-btn
              color="primary"
              :key="index"
              @click="toggleModal(user.id, index)"
            >
              More details
            </v-btn>
          </template>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
  <Modal></Modal>
</template>
