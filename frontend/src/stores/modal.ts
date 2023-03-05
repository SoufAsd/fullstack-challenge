import { ref, computed } from "vue";
import { defineStore } from "pinia";

export interface modalInterface {
modal : Boolean
}

export const useModalStore = defineStore("useModal", {
  state: () => ({
    modal:false,
    user_id:0
  }),
  actions: {
    toggleModal(){
        this.modal = !this.modal;
    },
    setUserId(user_id : number){
        this.user_id = user_id
    }
  },
  getters: {
    getModalStatus(): boolean {
      return this.modal;
    },
    getUserId() : Number {
        return this.user_id
    }
  },
});
