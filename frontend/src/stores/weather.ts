import { ref, computed } from "vue";
import { defineStore } from "pinia";

export interface WeatherInterface {
  user_id: number;
  temperature: string;
  weather: any;
  humidity: any;
  wind: any;
}

export const useWeatherStore = defineStore("useWeather", {
  state: () => ({
    users : undefined as WeatherInterface[] | undefined,
    weather: {} as WeatherInterface
  }),
  actions: {
    setWeatherSelected(index : number){
      this.weather = this.users![index];
    },
    setWeathers(users : WeatherInterface[] | undefined){
      this.users = users;
    }
  },
  getters: {
    getWeather(): WeatherInterface | undefined {
      return this.weather;
    },
  },
});
