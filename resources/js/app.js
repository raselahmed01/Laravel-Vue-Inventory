
require('./bootstrap');


// window.Vue = require('vue').default;

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

//Routes Imported

import {routes} from './routes';
const router = new VueRouter({
  routes,
  mode:'history'
});


//Import User Helper Class

import  User   from './Helpers/User';
window.User = User;





const app = new Vue({
    el: '#app',
    router,
   
});
