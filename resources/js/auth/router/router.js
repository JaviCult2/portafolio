import Vue from "vue";
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import App from "../views/App";

const prefix = '/login/app';

let routes = [
    {
        path: prefix + '/home',
        component: App,
        name: 'home'
    }
];

export default new VueRouter({
    mode: 'history',
    routes: routes
})
