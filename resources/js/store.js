import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        sidebar_is_mini: false,
        showBanner: true,
        productsItems: [],
        filterSearch: true,
    },

    mutations: {
    },

    //computed
    getters: {
    },

    //methods
    actions: {
    }
});