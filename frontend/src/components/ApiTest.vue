<script lang="ts" setup>
import { ref } from "vue";

interface users{
  users:{}
}

const url = "http://localhost:8000/";

const apiResponse = ref<users>();

const fetchApi = async (url: string) => {
  apiResponse.value = await (await fetch(url)).json();
};

fetchApi(url);
</script>

<template>
  <v-container class="bg-surface-variant">
    <v-row no-gutters>
      <v-col v-for="(user,index) in apiResponse?.users" :key="index" cols="12" sm="3">
        <v-card class="ma-2" width="200">
          <template v-slot:title> {{ user.name }} </template>

          <template v-slot:subtitle> This is a subtitle </template>

          <template v-slot:text> This is content </template>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
