import Vue from "vue";
import Vuex from "vuex";
import modules from "./modules";
import VuexPlugins from "../plugins/vuex-plugins";
import mutations from "./mutations";
import actions from "./actions";
import getters from "./getters";

Vue.use(Vuex);

const state = () => ({
  notifications: [],
  errors: [],
});

export default new Vuex.Store({
  state,
  getters,
  mutations,
  actions,
  modules,
  plugins: [VuexPlugins],
});
