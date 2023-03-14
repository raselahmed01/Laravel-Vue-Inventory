
require('./bootstrap');


// window.Vue = require('vue').default;

import Vue from 'vue';



import VueRouter from 'vue-router';


Vue.use(VueRouter);

const Routes=[];
const router = new VueRouter({
  routes: Routes
}); 


Vue.component('example-component', require('./components/ExampleComponent.vue').default);



const app = new Vue({
    el: '#app',
  router: router
   
});
