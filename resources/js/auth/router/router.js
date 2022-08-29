import Vue from "vue";
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import App from "../views/App";

let routes = [
    {
        path: '/home',
        component: App,
        name: 'home'
    }
];

export default new VueRouter({
    mode: 'history',
    routes: routes
})
