import Vue from "vue";

import router from './router/router';
import store from "./store/store";
import vuetify from "./vuetify/vuetify"

import App from "./views/App"

export const bus = new Vue();

const app = new Vue({
    el: '#app',
    router,
    vuetify,
    store,
    render: h => h(App)
});
