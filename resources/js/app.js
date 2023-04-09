
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

//Import Notification Helper Class

import Notification from './Helpers/Notification';
window.Notification = Notification;


//Sweet Alert Start

import Swal from 'sweetalert2';
window.Swal=Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

window.Toast=Toast;




//Sweet Alert End



const app = new Vue({
    el: '#app',
    router,
   
});
